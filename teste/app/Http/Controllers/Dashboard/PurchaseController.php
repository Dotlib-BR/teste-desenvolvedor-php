<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUpdatePurchaseFormRequest;
use App\Models\Client;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->query->add(['page' => $request->page ?? 1]);

        $url = url('/zeus/purchases/?'.http_build_query($request->query->all()));

        try {
            $response = consumeZeus($url);

            $purchases = $response->data;
            $pages = $response;

            if (! isset($response->data)) {
                //se der muitos refresh na tela também cai aqui.
                sleep(5);

                return redirect()->back()
                    ->with([
                        'request' => 'Timeout.'
                    ]);
            }

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        $params = removePage($request->query->all());

        return view(
            'dashboard.purchases.index',
            compact('purchases', 'pages', 'params')
        );
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
        $statuses = Status::where('title', '<>', 'Cancelado')->get();

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
            consumeZeus(
                route('purchases.store', $request->all()),
                'POST',
                $request->all()
            );

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        return redirect()->route('dashboard.purchases.index')
            ->with([
                'action' => 'Ação realizada.'
            ]);
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
        // O pedido está ligado a uma compra, então tenho que manipular a compra.

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
            consumeZeus(
                route('purchases.update', $id),
                'PUT',
                $request->all()
            );

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        return redirect()->route('dashboard.purchases.index')
            ->with([
                'action' => 'Ação realizada.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Http\RedirectResponse|string
     */
    public function destroy($id)
    {
        try {
            consumeZeus(route('purchases.destroy', $id), 'DELETE');

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        return redirect()->back()
            ->with([
                'action' => 'Ação realizada.'
            ]);
    }
}
