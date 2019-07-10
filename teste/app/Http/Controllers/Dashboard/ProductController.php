<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUpdateProductFormRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
            $products = Product::where('name', 'like', '%'.request('search', '').'%')
                ->orWhere('barcode', 'like', '%'.request('search', '').'%')
                ->orWhere('price', substr_replace(removeMask(request('search', '')), '.', -2, 0))
                ->orderBy(request('field_sort', 'id'), request('sort', 'asc'))
                ->paginate(request('per_page', 20));

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return redirect()->route('login');// TODO retornar com uma mensagem explicando o motivo do logout.
        }

        return view('dashboard.products.index', compact('products'));
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
            Product::create($request->validated());

            return redirect()->route('dashboard.products.index')
                ->with([
                    'notification' => [
                        'message' => 'Produto cadastrado com sucesso!',
                        'color' => 'success'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.products.index')
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
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)// 404 se não existir
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
    public function edit(Product $product)// 404 se não existir
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
    public function update(StoreUpdateProductFormRequest $request, $id)
    {
        try {
            $product = Product::find($id);

            if (! empty($product)) {
                $product->update($request->validated());

                return redirect()->route('dashboard.products.index')
                    ->with([
                        'notification' => [
                            'message' => 'Produto atualizado com sucesso!',
                            'color' => 'success'
                        ]
                    ]);
            }

            return redirect()->route('dashboard.products.index')
                ->with([
                    'notification' => [
                        'message' => 'O produto que você deseja atualizar não existe!',
                        'color' => 'warning'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.products.index')
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {// Estou usando observers para remover os registros relacionados.
            $product = Product::find($id);

            if (! empty($product)) {
                $product->delete();

                return redirect()->route('dashboard.products.index')
                    ->with([
                        'notification' => [
                            'message' => 'Produto removido com sucesso!',
                            'color' => 'success'
                        ]
                    ]);
            }

            return redirect()->route('dashboard.products.index')
                ->with([
                    'notification' => [
                        'message' => 'O produto que você está tentando remover não existe!',
                        'color' => 'warning'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.products.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
        }
    }
}
