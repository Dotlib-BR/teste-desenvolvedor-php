<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function Pedidos(Request $request){
        $ordem= $request->input("ordem") ? $request->input("ordem") : ['id','desc'];
        $search = $request->input("search") ? $request->input("search") : "" ;
        return \App\model\Pedido::with(['cliente','pedidoDetalhe.produto'])->orderBy($ordem[0],$ordem[1])->paginate(20)->toJson();
    }
}
