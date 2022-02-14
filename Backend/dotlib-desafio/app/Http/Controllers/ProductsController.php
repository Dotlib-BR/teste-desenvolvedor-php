<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show()
    {
        return Product::all();
    }

    public function store(Request $request)
    {

        $product = Product::create([
            'nameProduct' => $request->input('nameProduct'),
            'barCod' => $request->input('barCod'),
            'unitValue' => $request->input('unitValue'),
            'amount' => $request->input('amount'),
        ]);

        return $product;
    }

    public function getOne(Product $product)
    {

        return $product;
    }

    public function update(Request $request, Product $product)
    {

        $product->nameProduct = $request->input('nameProduct');
        $product->barCod = $request->input('barCod');
        $product->unitValue = $request->input('unitValue');
        $product->amount = $request->input('amount');
        $product->save();
        return $product;
    }

    public function delete(Product $product)
    {

        $product->delete();

        return response()->json(['success' => true]);
    }
}
