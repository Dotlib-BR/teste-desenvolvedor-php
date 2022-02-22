<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'required|numeric',
        ]);

        return Product::paginate($request->input('per_page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'name' => 'required|string|unique:App\Models\Product,name',
            'barcode' => 'required|unique:App\Models\Product,barcode',
            'price' => 'required|numeric',
        ]);

        Product::create($validatedFields);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch(ModelNotFoundException $error) {
            return response(['message' => 'Product not found'], 404);
        }
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'unique:App\Models\Product,name',
            'barcode' => 'unique:App\Models\Product,barcode',
            'price' => 'numeric', 
        ]);

        try {
            $product = Product::findOrFail($id)
                ->update($request->all());
        } catch(ModelNotFoundException $error) {
            return response(['message' => 'Product not found'], 404);
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
        $success = Product::destroy($id);
        if (! $success) {
            return response (['message' => 'Product not found'], 404);
        }
        return response (['message' => 'Product successfully deleted']);
    }
}
