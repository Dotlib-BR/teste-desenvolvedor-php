<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsRepository
{
    public function __construct(){}

    public function store(Request $request) {
        if(!$request->get('name'))
            $request->merge(['name' => 'Produto sem nome']);

        $request->merge(['unit_value' => $this->removeMoneyMask($request->get('unit_value'))]);
        $product = new Product();
        $product->create($request->all());
        return $product;
    }

    public function destroyProductByIdAjax($id) {
        $product = Product::find($id);
        $product->delete();
        return $product;
    }

    public function getProductByIdAjax($id) {
        $product = Product::find($id);
        return $product;
    }

    public function updateProductByIdAjax(Request $request) {
        $request->merge(['unit_value' => $this->removeMoneyMask($request->get('unit_value'))]);

        $product = Product::find($request->get('id'));
        $product->update($request->all());
        return $product;
    }

    public function removeMoneyMask($money) {
        return str_replace('R$ ', '', $money);
    }
}
