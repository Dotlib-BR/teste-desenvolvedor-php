<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Pedidos;
use App\Models\Products;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(Request $response)
    {
        $clients = Clients::orderBy('id','desc')->take(5)->get();
        $products = Products::orderBy('id','desc')->take(5)->get();
        $pedidos = Pedidos::orderBy('id','desc')->take(5)->get();
        $clientsAll = Clients::all();
        $productsAll = Products::all();
        $pedidosAll = Pedidos::all();

        return response()->json([
            'clients' => $clients,
            'products' => $products,
            'pedidos' => $pedidos,
            'clientsAll' => $clientsAll,
            'productsAll' => $productsAll,
            'pedidosAll' => $pedidosAll,
        ]);
    }
}
