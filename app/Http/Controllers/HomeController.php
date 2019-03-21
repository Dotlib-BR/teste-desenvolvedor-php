<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Order $order)
    {
        $clients = Auth::user()
            ->clients()
            ->count();

        $products = Product::count();
        $orders = $order->getOrdersFromUser(Auth::user()->id);

        return view('home', compact('clients', 'products', 'orders'));
    }
}
