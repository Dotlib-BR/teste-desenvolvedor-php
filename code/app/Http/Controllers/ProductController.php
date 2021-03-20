<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->expectsJson())
            return new ProductCollection(Product::all());

        return view("product.index", ["products" => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "string|required|max:100",
            "bar_code" => "string|required|max:20",
            "price" => "numeric|required",
            "quantity" => "integer|required"
        ]);

        $product = Product::create($request->only("name", "bar_code", "price", "quantity"));

        if($request->expectsJson())
            return new ProductResource($product);

        return redirect()->route("product.index")->with("success","Produto cadastrado!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        if($request->expectsJson())
            return new ProductResource($product);

        return view("product.show", ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("product.edit", ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" => "string|required|max:100",
            "bar_code" => "string|required|max:20",
            "price" => "numeric|required",
            "quantity" => "integer|required"
        ]);

        $product->fill($request->only("name", "bar_code", "price", "quantity"));
        $product->save();

        if($request->expectsJson())
            return new ProductResource($product);

        return redirect()->route("product.index")->with("success","Produto atualizado!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if($request->expectsJson())
            return response()->json()->setStatusCode(204);

        return redirect()->route("product.index")->with("success","Produto deletado!");
    }

    public function multDestroy(Request $request)
    {
        $request->validate([
            "products_id" => "required|array"
        ]);

        Product::destroy($request->get("products_id"));

        return redirect()->route("product.index")->with("success","Produtos deletados!");
    }
}
