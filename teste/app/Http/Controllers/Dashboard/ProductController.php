<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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

        $url = url('/zeus/products/?'.http_build_query($request->query->all()));

        try {
            $response = consumeZeus($url);

            $products = $response->data;
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
            'dashboard.products.index',
            compact('products', 'pages', 'params')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProductFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductFormRequest $request)
    {
        try {
            consumeZeus(
                route('products.store', $request->all()),
                'POST',
                $request->all()
            );

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        return redirect()->route('dashboard.products.index')
            ->with([
                'action' => 'Ação realizada.'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $orders = $product->orders()->paginate(5);

        return view(
            'dashboard.products.show',
            compact('product', 'orders')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.form', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProductFormRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            consumeZeus(
                route('products.update', $id),
                'PUT',
                $request->all()
            );

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        return redirect()->route('dashboard.products.index')
            ->with([
                'action' => 'Ação realizada.'
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            consumeZeus(route('products.destroy', $id), 'DELETE');

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
