<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function getProduct()
    {
        $products = Product::where('active', 1)->get();
        return view("backend.product.list", ['products' => $products]);
    }

    public function getProductDetail($id)
    {
        $product = Product::findOrFail($id);
        if($product)
            if($product->active)
                return view("backend.product.detail", ['product' => $product]);
            else
                abort(403);
        else
            abort(404);
    }

    public function getProductByBarcode(Request $request)
    {
        $barcode = $request->barcode;
        $product =  Product::where('barcode', $barcode)->where('active', 1)->first();
        if($product)
            if($product->active)
                return $product;
            else
                return abort(403, "Produto desativado");
        else
            return abort(404, "Nenhum produto cadastrado com este código de barras");
    }
    
    public function getProductCreate()
    {
        return view("backend.product.create");
    }

    public function getProductEdit($id)
    {
        $product = Product::findOrFail($id);

        if($product)
            return view("backend.product.edit", ['product' => $product]);
        else
            abort(404);
    }

    public function postProductCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'max:100|nullable',
            'barcode' => 'required|unique:products|max:20|min:20',
            'price' => 'required',
        ]);

        $price_replace= str_replace(['.', ','], ['', '.'], $request->price);

        $product = new Product();
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->price = (double) $price_replace;
        $product->active = 1;

        $product->save();

        return redirect('/product/list');
    }

    public function putProductEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'max:100|nullable',
            'barcode' => 'required|max:20|min:20|unique:products,barcode,'. $id,
            'price' => 'required'
        ]);

        $product = Product::findOrFail($id);

        if($product)
        {
            $price_replace= str_replace(['.', ','], ['', '.'], $request->price);

            $product->name = $request->name;
            $product->barcode = $request->barcode;
            $product->price = (double) $price_replace;
            $product->save();

            return redirect('/product/list');
        }
        else
            abort(404);
    }

    public function putProductDeactive($id)
    {
        $product = Product::findOrFail($id);
        if($product)
        {
            $product->active = 0;
            $product->save();

            return redirect('/product/list');
        }
        else
            abort(404);
    }

}
