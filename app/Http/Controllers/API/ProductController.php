<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name'  => 'required|string|min:4|max:100',
            'price' => 'required|numeric',
            'code'  => 'required|numeric|unique:products,code'
        ], $this->messages());

        if ($validator->passes()) {
            $product = null;

            DB::transaction(function() use($request, &$product) {
                $product = Product::create($request->except('_token'));
            });

            if ($product) {
                return response()->json($product, 201);
            }
        }

        return response()->json([
            'errors' => $validator->errors()
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json($product);
        }

        return response()->json(false, 404);
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
        $product = Product::find($id);

        if ($product) {
            $validator = validator()->make($request->all(), [
                'name'  => 'required|string|min:4|max:100',
                'price' => 'required|numeric',
                'code'  => 'required|numeric|unique:products,code,' . $product->id
            ], $this->messages());

            if ($validator->passes()) {
                $data = $request->only(['name', 'price', 'code']);

                DB::transaction(function() use($product, $data) {
                    $product->update($data);
                });

                return response()->json($product);
            }

            return response()->json([
                'errors' => $validator->errors()
            ], 500);
        }

        return response()->json(false, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            DB::transaction(function() use($product) {
                $product->delete();
            });

            return response()->json(true);
        }

        return response()->json(false, 404);
    }

    /**
     * Validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'id.required'     => 'Selecione os produtos.',
            'id.array'        => 'Produtos inválidos.',
            'name.required'   => 'Insira o nome.',
            'name.string'     => 'Nome inválido.',
            'name.min'        => 'O nome deve conter no mínimo :min caracteres.',
            'name.max'        => 'O nome deve conter no máximo :max caracteres.',
            'price.required'  => 'Insira o preço.',
            'price.numeric'   => 'Preço inválido.',
            'code.required'   => 'Insira o código de barras.',
            'code.numeric'    => 'Código de barras inválido.',
            'code.unique'     => 'Código de barras em uso.'
        ];
    }
}
