<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(Request $response)
    {
        $clients = Clients::all();

        $products = [[
            'id' => 1,
            'name' => 'Vídeo Gamer',
            'valor' => '10.50'
        ]];

        return response()->json([
            'clients' => $clients,
            'products' => $products,
        ]);
    }
}
