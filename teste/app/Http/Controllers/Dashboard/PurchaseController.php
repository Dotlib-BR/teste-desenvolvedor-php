<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUpdatePurchaseFormRequest;
use App\Models\Client;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // Caso dê algo errado nos métodos que fazem alterações no banco eu uso o DB::beginTransaction()
        $this->middleware(
            'db.transaction',
            [
                'except' => ['index', 'edit', 'show']
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $purchases = DB::table('purchases')// A forma mais simples e legivél para fazer foi usando o query builder.
                ->join('orders', function ($q) {
                    $q->on('orders.purchase_id', '=','purchases.id');
                    $q->whereNull('orders.deleted_at');
                })
                ->join('products', function ($q) {
                    $q->on('orders.product_id', '=', 'products.id');
                    $q->whereNull('products.deleted_at');
                })
                ->join('clients', function ($q) {
                    $q->on('purchases.client_id', '=','clients.id');
                    $q->whereNull('clients.deleted_at');
                })
                ->join('statuses', function ($q) {
                    $q->on('purchases.status_id', '=','statuses.id');
                    $q->whereNull('statuses.deleted_at');
                })
                ->whereNull('purchases.deleted_at')
                ->orWhere('quantity', request('search', ''))
                ->orWhere('products.name', 'like', '%'.request('search', '').'%')
                ->orWhere('barcode', 'like', '%'.request('search', '').'%')// Consulta por código de barra do produto
                ->orWhere('clients.name', 'like', '%'.request('search', '').'%')
                ->orWhere('cpf', removeMask(request('search', '')))// Consultar por cpf do cliente
                ->orWhere('statuses.title', 'like', '%'.request('search', '').'%')
                ->orWhere('purchases.invoice_number', 'like', '%'.request('search', '').'%')
                ->select([
                    'purchases.id', 'purchases.invoice_number', 'orders.quantity', 'products.name as product',
                    'clients.name as client',
                    'statuses.title as status'
                ])
                ->orderBy(request('field_sort', 'id'), request('sort', 'asc'))
                ->paginate(request('per_page', 20));

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return redirect()->route('login');// TODO retornar com uma mensagem explicando o motivo do logout.
        }

        return view('dashboard.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get(['id', 'cpf', 'name']);
        $products = Product::get(['id', 'name', 'price']);
        $discounts = Discount::get();
        $statuses = Status::get();

        return view('dashboard.purchases.form',
            compact(
                'clients', 'products',
                'discounts', 'statuses'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePurchaseFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePurchaseFormRequest $request)
    {
        try {
            $total = [];

            $purchase = new Purchase();

            $purchase->client_id = $request->validated()['client_id'];
            $purchase->status_id = $request->validated()['status_id'];
            $purchase->invoice_number = Str::random(9);
            $purchase->total = 0;

            if ($request->has('discount_id')) {
                $purchase->discount_id = $request->validated()['discount_id'];
            }

            $purchase->save();

            foreach ($request->validated()['quantity'] as $key => $value) {
                array_push(
                    $total,
                    Product::find($request->validated()['product_id'][$key])
                        ->price * $value
                );

                $order = new Order();

                $order->product_id = $request->validated()['product_id'][$key];
                $order->purchase_id = $purchase->id;
                $order->quantity = $value;
                $order->save();
            }

            $purchase->update(['total' => array_sum($total)]);

            return redirect()->route('dashboard.purchases.index')
                ->with([
                    'notification' => [
                        'message' => 'Compra realizada e seus pedidos cadastrados com sucesso!',
                        'color' => 'success'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.purchases.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Purchase $purchase
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Purchase $purchase)
    {
        $orders = $purchase->orders()->paginate(5);

        return view(
            'dashboard.purchases.show',
            compact('purchase', 'orders')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $clients = Client::get(['id', 'cpf', 'name']);
        $products = Product::get(['id', 'name', 'price']);
        $discounts = Discount::get();
        $statuses = Status::get();;
        $firstProduct = $purchase->orders
            ->first()->product_id;
        $firstQuantity = $purchase->orders
            ->first()->quantity;

        return view('dashboard.purchases.form',
            compact(
                'clients', 'products',
                'discounts', 'statuses', 'purchase',
                'firstProduct', 'firstQuantity'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdatePurchaseFormRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePurchaseFormRequest $request, $id)
    {
        try {
            $purchase = Purchase::find($id);

            if (! empty($purchase)) {
                $total = [];

                $purchase = Purchase::find($id);

                $purchase->orders()->delete();
                // Isso vai funciona parecido com detach manual

                foreach ($request->validated()['quantity'] as $key => $value) {
                    array_push(
                        $total,
                        Product::find($request->validated()['product_id'][$key])->price * $value
                    );

                    $order = new Order();

                    $order->product_id = $request->validated()['product_id'][$key];
                    $order->purchase_id = $purchase->id;
                    $order->quantity = $value;

                    $order->save();
                }

                $purchase->update([
                    'total' => array_sum($total),
                    'client_id' => $request->validated()['client_id'],
                    'status_id' => $request->validated()['status_id'],
                    'discount_id' => $request->has('discount_id') ?
                        $request->validated()['discount_id'] :
                        null
                ]);

                return redirect()->route('dashboard.purchases.index')
                    ->with([
                        'notification' => [
                            'message' => 'Os pedidos da sua compra foram atualizados com sucesso!',
                            'color' => 'success'
                        ]
                    ]);
            }

            return redirect()->route('dashboard.purchases.index')
                ->with([
                    'notification' => [
                        'message' => 'A compra que você deseja atualizar um pedido não existe!',
                        'color' => 'warning'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.purchases.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Http\RedirectResponse|string
     */
    public function destroy($id)
    {
        // Estou usando observers para remover os registros relacionados.
        try {
            $purchase = Purchase::find($id);

            if (! empty($purchase)) {
                $purchase->delete();

                return redirect()->route('dashboard.purchases.index')
                    ->with([
                        'notification' => [
                            'message' => 'Sua compra e os pedidos que fazem parte dela foram removidos!',
                            'color' => 'success'
                        ]
                    ]);
            }

            return redirect()->route('dashboard.purchases.index')
                ->with([
                    'notification' => [
                        'message' => 'A compra que você está tentando remover não existe!',
                        'color' => 'warning'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.purchases.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
        }
    }
}
