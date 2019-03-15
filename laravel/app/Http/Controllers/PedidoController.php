<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function Pedidos(){
        return \App\model\Pedido::with(['cliente','produto'])->paginate(20)->toJson();
    }
}
