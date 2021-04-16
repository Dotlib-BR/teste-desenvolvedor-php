<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pedido;

class ClienteController extends Controller
{
    public function dashboard(){
        return view('cliente.dashboard');
    }

    public function compraStatus($status)
    {
        //
       if($status ==='aprovado'){
         $verifica =1;
         return view('partials.frontend.checkout.resultado')->with(compact('verifica'));
       }elseif($status ==='reprovado'){
        $verifica =0;
        return view('partials.frontend.checkout.resultado')->with(compact('verifica'));
       }else{
        return redirect()->route('index');
       }
    }

    public function compraLista(){
       
        $pedidos = Pedido::where('user_id',Auth::user()->id)->get();
        return view('cliente.minhas-compras')->with(compact('pedidos'));
    }

    public function showCompra($id)
    {
        //
        $pedido = Pedido::find($id);
        if($pedido){
            
            return view('admin.pedido-detalhado')->with(compact('pedido'));
        }else{
            return redirect()->route('ClienteDashboard');
        }
    }
}
