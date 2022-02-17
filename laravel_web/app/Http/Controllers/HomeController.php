<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientes_ativos = Clientes::all()->where('status', 1);
        $clientes_inativos = Clientes::all()->where('status', 0);
        $produtos_ativos = Produtos::all()->where('status', 1);
        $produtos_inativos = Produtos::all()->where('status', 0);
        $pedidos_cancelados = Pedidos::all()->where('status', 0);
        $pedidos_abertos = Pedidos::all()->where('status', 1);
        $pedidos_pagos = Pedidos::all()->where('status', 2);
        $data = [
            'clientes_ativos' => $clientes_ativos,
            'clientes_inativos' => $clientes_inativos,
            'produtos_ativos' => $produtos_ativos,
            'produtos_inativos' => $produtos_inativos,
            'pedidos_cancelados' => $pedidos_cancelados,
            'pedidos_abertos' => $pedidos_abertos,
            'pedidos_pagos' => $pedidos_pagos,
        ];

        return view('home', $data);
    }
}
