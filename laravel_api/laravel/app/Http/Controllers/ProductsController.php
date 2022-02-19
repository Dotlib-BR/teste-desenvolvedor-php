<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function all()
    {
        $products = Products::all();

        return response()->json($products);
    }

    public function add(ProductAddRequest $request)
    {
        if ($request->validated()) {
            $product = new Products();
            $product->cod_bars = $request->cod_bars;
            $product->name = $request->name;
            $product->value = $request->value;
            $product->amount = $request->amount;
            $product->stats = $request->stats;
            $product->save();
            
            return response()->json('success');
        }
    }

    public function show(Products $product, Request $request)
    {
        return response()->json($product);
    }

    public function serchID(Products $product, Request $request)
    {
        return response()->json($product);
    }

    public function update(Products $product, ProductUpdateRequest $request)
    {   
        if ($request->validated()) {
            if ($request->amount == 0)
                $stats = 0;
            else
                $stats = $request->stats;

            $product->cod_bars = $request->cod_bars;
            $product->name = $request->name;
            $product->value = $request->value;
            $product->amount = $request->amount;
            $product->stats = $stats;
            $product->save();

            return response()->json('success');
        }
    }

    public function delete(Products $product, Request $request)
    {
        if ($product->delete()) {
            return response()->json('success');
        }
    }
}
