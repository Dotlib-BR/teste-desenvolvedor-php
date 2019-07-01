<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\User;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products')->get();
        return response()->json($orders);
    }

    /**
     * Display a listing of the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userOrders($id)
    {
        $orders = Order::where('user_id', $id)->with('products')->get();
        return response()->json($orders);
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
            'user_id'           => 'required|exists:users,id',
            'product'           => 'required|array',
            'product.*.id'      => 'required|exists:products,id',
            'product.*.amount'  => 'required|integer',
            'discount'          => 'required|numeric'
        ], $this->messages());

        if ($validator->passes()) {
            $order = null;

            DB::transaction(function() use($request, &$order) {
                $order = Order::create([
                    'user_id'  => $request->user_id,
                    'discount' => $request->discount,
                    'status'   => $request->status
                ]);

                $products = [];

                foreach ($request->product as $product) {
                    $products[] = new OrderProduct([
                        'product_id' => $product['id'],
                        'amount'     => $product['amount']
                    ]);
                }

                $order->products()->saveMany($products);
            });

            if ($order) {
                $order = Order::with('products')->find($order->id);
                return response()->json($order);
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
        $order = Order::with('products')->find($id);

        if ($order) {
            return response()->json($order);
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
        $order = Order::with('products')->find($id);

        if ($order) {
            $validator = validator()->make($request->all(), [
                'user_id'           => 'required|exists:users,id',
                'product'           => 'required|array',
                'product.*.id'      => 'required|exists:products,id',
                'product.*.amount'  => 'required|integer',
                'discount'          => 'required|numeric'
            ], $this->messages());

            if ($validator->passes()) {
                DB::transaction(function() use($order, $request) {
                    $order->discount = $request->discount;
                    $order->status   = $request->status;
                    $order->save();

                    $products = [];

                    foreach ($request->product as $product) {
                        $products[] = new OrderProduct([
                            'product_id' => $product['id'],
                            'amount'     => $product['amount']
                        ]);
                    }

                    $order->products()->delete();
                    $order->products()->saveMany($products);
                });

                $order = Order::with('products')->find($order->id);
                return response()->json($order);
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
        $order = Order::find($id);

        if ($order) {
            DB::transaction(function() use($order) {
                $order->delete();
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
            'id.required'           => 'Selecione os pedidos.',
            'id.array'              => 'Pedidos inválidos.',
            'user_id.required'      => 'Selecione o comprador.',
            'user_id.exists'        => 'O comprador não foi encontrado.',
            'product.required'      => 'É necessário ter ao menos um produto no pedido.',
            'product.array'         => 'Produtos inválidos.',
            'product.*.id.required' => 'Selecione o produto.',
            'product.*.id.exists'   => 'O produto não foi encontrado.',
            'product.*.amount'      => 'Insira a quantidade.',
            'discount.required'     => 'Insira o desconto.',
            'discount.numeric'      => 'Desconto inválido.'
        ];
    }
}
