<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->expectsJson())
            return new OrderCollection(Order::with('client')->get());

        return view("order.index", ["orders" => Order::with("client")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("order.create", ["products" => Product::all(), "clients" => CLient::all()]);
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
            "date" => "date|required",
            "status" => "string|required",
            "products" => "array|required|min:1",
            "quantities" => "array|required|min:1",
            "client_id" => "required|integer"
        ]);

        $order = Client::find($request->get("client_id"))->orders()->create($request->only("date", "status"));

        $quantities = $request->get("quantities");
        $products = collect($request->get("products"))->mapWithKeys(fn($id, $key) => [$id => ["quantity" => $quantities[$key]]]);

        $order->products()->attach($products);

        if($request->expectsJson())
            return new OrderResource($order->with(['client', 'products'])->first());

        return redirect()->route("order.index")->with("success","Pedido cadastrado!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        if($request->expectsJson())
            return new OrderResource($order->with(['client', 'products'])->first());

        return view("order.show", ["order" => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view("order.edit", ["order" => $order->with("products")->first(), "allProducts" => Product::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            "date" => "date|required",
            "status" => "string|required",
            "products" => "array|required|min:1",
            "quantities" => "array|required|min:1"
        ]);

        $order->fill($request->only("date", "status"));
        $order->save();

        $quantities = $request->get("quantities");
        $products = collect($request->get("products"))->mapWithKeys(fn($id, $key) => [$id => ["quantity" => $quantities[$key]]]);

        $order->products()->sync($products);

        if($request->expectsJson())
            return new OrderResource($order->with(['client', 'products'])->first());

        return redirect()->route("order.index")->with("success","Pedido atualizado!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Order $order)
    {
        $order->products()->detach();
        $order->delete();

        if($request->expectsJson())
            return response()->json()->setStatusCode(204);

        return redirect()->route("order.index")->with("success","Pedido deletado!");
    }

    public function multDestroy(Request $request)
    {
        $request->validate([
            "orders_id" => "required|array"
        ]);

        Order::destroy($request->get("orders_id"));

        return redirect()->route("order.index")->with("success","Pedidos deletados!");
    }
}
