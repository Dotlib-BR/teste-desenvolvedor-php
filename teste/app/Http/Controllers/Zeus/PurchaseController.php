<?php

namespace App\Http\Controllers\Zeus;

use App\Http\Requests\StoreUpdatePurchaseFormRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // Caso dê algo errado nos métodos que fazem alterações no banco eu uso o DB::beginTransaction()
        $this->middleware(
            'db.transaction',
            ['except' =>
                ['index', 'edit', 'show']
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Preciso fazer essas simples verificações para não quebrar nos testes.
        $search = $request->search ?? '';
        $fieldSort = $request->field_sort ?? 'id';
        $sort = $request->sort ?? 'asc';
        $perPage = $request->per_page ?? 20;

        $orders = DB::table('purchases')// A forma mais simples e legivél para fazer foi usando o query builder.
            ->join('orders', 'orders.purchase_id', '=','purchases.id')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('clients', 'purchases.client_id', '=','clients.id')
            ->join('statuses', 'purchases.status_id', '=','statuses.id')
            ->where('quantity', $search)
            ->orWhere('products.name', 'like', '%'.$search.'%')
            ->orWhere('barcode', 'like', '%'.$search.'%')// Consulta por código de barra do produto
            ->orWhere('clients.name', 'like', '%'.$search.'%')
            ->orWhere('cpf', removeMask($search))// Consultar por cpf do cliente
            ->orWhere('statuses.title', 'like', '%'.$search.'%')
            ->orWhere('purchases.invoice_number', 'like', '%'.$search.'%')
            ->select([
                'purchases.id', 'purchases.invoice_number', 'orders.quantity', 'products.name as product',
                'clients.name as client',
                'statuses.title as status'
            ])
            ->orderBy($fieldSort, $sort)
            ->paginate($perPage);

        return response()->json($orders, Response::HTTP_OK);//200
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdatePurchaseFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePurchaseFormRequest $request)
    {
        $total = [];

        $purchase = new Purchase();

        $purchase->client_id = $request->validated()['client_id'];
        $purchase->status_id = $request->validated()['status_id'];
        $purchase->invoice_number = Str::random(9);

        if ($request->has('discount_id')) {
            $purchase->discount_id = $request->validated()['discount_id'];
        }

        $purchase->total = 0;
        $purchase->save();

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

        $purchase->update(['total' => array_sum($total)]);

        return response()->json($request->validated(), Response::HTTP_CREATED);// 201
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Purchase::find($id), Response::HTTP_OK);
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

        return response()->json($request->validated(), Response::HTTP_OK);// 200
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::find($id)->delete();
        // Não preciso de observer pois estou utilizando o onDelete('cascade') e deletando com forceDelete().

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
