<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        return view('dashboard.home',["title"=>"HOME"]);
    }

    public function produto(){
        return view('dashboard.produto',["title"=>"PRODUTO"]);
    }

    public function cliente(){
        return view('dashboard.cliente',["title"=>"CLIENTE"]);
    }

    public function pedido(){
        return view('dashboard.pedido',["title"=>"PEDIDO"]);
    }


}
