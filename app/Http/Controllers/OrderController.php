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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $orders = $order->load(['status', 'client'])
            ->whereHas('client', function ($q) {
                $q->where('user_id', Auth::user()->id);
            })
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

    public function filter(Request $request, Order $order, Client $client)
    {
        $page = $request->input('paged');
        $search = $request->input('search');
        $filters = $request->input('filter');
        $query = $order->newQuery()
            ->with('client')
            ->whereHas('client', function ($q) use ($search, $filters) {
                $q->where('clients.user_id', Auth::user()->id);

                    if ($filters && in_array('name', $filters)) {
                        $q->where('clients.name', 'LIKE', '%' . $search . '%');
                    }
            });
            
        if ($filters) {
            // Status
            if (in_array('status_id', $filters)) {
                $query->whereHas('status', function ($q) use ($search) {
                    $q->where('name', $search);
                });
            }
    
            // Number
            if (in_array('number', $filters)) {
                $query->where('orders.number', 'LIKE', '%' . $search . '%');
            }
    
            // Discount
            if (in_array('discount', $filters)) {
                $query->where('orders.discount', 'LIKE', '%' . $search . '%');
            }
    
            // Date Order
            if (in_array('date_order', $filters)) {
                $dateFilter = implode('-', array_reverse(explode('/', $search)));
                $query->whereDate('orders.date_order', 'LIKE', '%' . $dateFilter . '%');
            };
        }

        $orders = $query->paginate($page)
            ->appends($request->except('page'));
        
        return view('order.index', compact('orders'));
    }

    /**
     * Add item to session cart.
     *
     * @param  Request $request
     * @param  CartService $cartService
     *
     * @return Illuminate\Http\Response
     */
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

    /**
     * Remove item from session cart.
     *
     * @param  Request $request
     * @param  CartService $cartService
     *
     * @return Illuminate\Http\Response
     */
    public function removeFromCart(Request $request, CartService $cartService)
    {
        $cartService->removeFromCart($request->input('product_id'));
        $cart = $cartService->getCart();

        return response()->json([
            'status' => true,
            'cart' => $cart,
        ]);
    }
}
