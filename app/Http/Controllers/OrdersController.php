<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Product;
use App\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $orders = Order::paginate(20);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        //$statuses = Status::all();

        return view('orders.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        Order::create($request->all());
        return redirect('orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order $order
     * @return Application|Factory|Response|View
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        $products = Product::all();
        $statuses = Status::all();

        return view('orders.edit', compact('order','customers', 'products', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  Order $order
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Order $order)
    {
        $order->fill($request->all());
        $order->save();

        return redirect('orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order $order
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('orders');
    }
}
