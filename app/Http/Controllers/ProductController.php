<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')
            ->paginate(20);
        
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->fill($request->all())
                ->save();
        });

        return redirect()
            ->route('products.create')
            ->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.manage', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductCreateRequest  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCreateRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($request->all());
        });

        return redirect()
            ->route('products.edit', $product->id)
            ->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->delete();
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto removido com sucesso!');
    }

    /**
     * Filter products
     *
     * @param  Request $request
     * @param  Product $client
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, Product $product)
    {
        $page = $request->input('paged');
        $search = $request->input('search');
        $filters = $request->input('filter');
        
        $query = $product->newQuery();

        if ($filters) {
            if (in_array('name', $filters)) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
    
            if (in_array('price', $filters)) {
                $query->where('price', 'LIKE', '%' . $search . '%');
            }
            
            if (in_array('bar_code', $filters)) {
                $query->where('bar_code', 'LIKE', '%' . $search . '%');
            }
        }
        
        $products = $query->paginate($page)
            ->appends($request->except('page'));
        
        return view('product.index', compact('products'));
    }
}
