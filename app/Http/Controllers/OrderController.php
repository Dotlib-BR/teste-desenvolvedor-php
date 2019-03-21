<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $orders = Order::with('status')
            ->orderBy('date_order', 'desc')
            ->get();
        
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client, CartService $cartService)
    {
        $cartService->removeCart();
        $statuses = Status::all();
        $products = Product::all();
        $clients = $client->getAllOrderByName();
        
        return view('order.manage', compact('statuses', 'products', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request, Order $order)
    {
        DB::transaction(function () use ($request, $order) {
            $order->fill($request->all())
                ->save();

            $order->products()
                ->attach($request->input('cart'));
        });

        return redirect()
            ->route('orders.create')
            ->with('success', 'Pedido criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order, Client $client, CartService $cartService)
    {
        $statuses = Status::all();
        $products = Product::all();
        $clients = $client->getAllOrderByName();
        $order->load(['client', 'status']);
        $cartService->loadCart($order);
        
        // $order->putProductsInCart();
        
        return view('order.manage', compact('statuses', 'order', 'products', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        DB::transaction(function () use ($request, $order) {
            $order->fill($request->all())
                ->save();
                
            $order->products()
                ->detach();
                
            $order->products()
                ->attach($request->input('cart'));
        });

        return redirect()
            ->route('orders.edit', $order->id)
            ->with('success', 'Pedido atualizado com sucesso!');
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

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pedido removido com sucesso com sucesso!');
    }

    public function addToCart(Request $request, CartService $cartService)
    {
        $quantity = $request->input("quantity");
        $product = Product::find($request->input('product_id'));
        
        $cartService->addToCart($product, $quantity);
        $cart = $cartService->getCart();
        
        return response()->json([
            'status' => true,
            'cart' => $cart,
        ]);
    }

    public function removeFromCart(Request $request, CartService $cartService) {
        $cartService->removeFromCart($request->input('product_id'));
        $cart = $cartService->getCart();

        return response()->json([
            'status' => true,
            'cart' => $cart,
        ]);
    }
}
