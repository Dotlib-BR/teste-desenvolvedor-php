<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param int $clientId
     *
     * @return \Illuminate\Http\Response
     */
    public function list($clientId = null, Order $order)
    {
        $query = $order->newQuery();

        if ($clientId) {
            $orders = $query->where('client_id', $clientId);
        }

        $orders = $query->get();

        foreach ($orders as $order) {
            $order->total = $order->total;
        }
        
        return response()->json($orders, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request, Order $order)
    {
        $cart = $request->input('cart');
        $ids = array_column($request->input('cart'), 'product_id');
        
        DB::transaction(function () use ($request, $order, $cart, $ids) {
            $products = Product::whereIn('id', $ids)->get();
    
            foreach ($cart as $key => $item) {
                $cart[$key]['price'] = $products->firstWhere('id', $item['product_id'])->price;
            }

            $order->fill($request->all())
                ->save();
                
            $order->products()
                ->attach($cart);
        });

        $order->total = $order->total;
        
        return response()->json($order, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order->total = $order->total;
        
        if ($order) {
            return response()->json($order, Response::HTTP_FOUND);
        }

        return response()->json([], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $cart = $request->input('cart');
        $ids = array_column($request->input('cart'), 'product_id');
        
        DB::transaction(function () use ($request, $order, $cart, $ids) {
            $products = Product::whereIn('id', $ids)->get();
    
            foreach ($cart as $key => $item) {
                $cart[$key]['price'] = $products->firstWhere('id', $item['product_id'])->price;
            }

            $order->fill($request->all())
                ->save();
                
            $order->products()
                ->detach();

            $order->products()
                ->attach($cart);
        });

        $order->total = $order->total;
        
        return response()->json($order, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        DB::transaction(function () use ($order) {
            $order->delete();
        });

        return response()->json(true, Response::HTTP_OK);
    }
}
