<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function getOne(Order $order)
    {
        return $order;
    }

    public function show()
    {
        return Order::getAllOrders();
    }

    public function store(Request $request)
    {

        $order = Order::create([
            'id_product' => $request->input('id_product'),
            'id_client' => $request->input('id_client'),
            'status' => $request->input('status'),
            'dtPedido' => $request->input('dtPedido'),
        ]);

        return $order;
    }

    public function update(Request $request, Order $order)
    {

        $order->id_product = $request->input('id_product');
        $order->id_client = $request->input('id_client');
        $order->status = $request->input('status');
        $order->dtPedido = $request->input('dtPedido');
        $order->save();
        return $order;
    }

    public function delete(Order $order)
    {

        $order->delete();

        return response()->json(['success' => true]);
    }
}
