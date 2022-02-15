<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFormRequest;
use App\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $products = Product::paginate(20);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsFormRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(ProductsFormRequest $request)
    {
        Product::create($request->all());
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return Application|Factory|Response|View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Product  $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());
        $product->save();
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('products');
    }
}
