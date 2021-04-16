<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use DB;
use DateTime;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $arrayMes=array();
        $pedidos = Pedido::all();
        $usuarios = User::all()->count();
        $usuariosADM = User::where('utype','ADM')->count();
        $cupons = Voucher::all();
        $pedidosHj = Pedido::whereDate('created_at', Carbon::today())->count();
        $arrecadacaoHJ = Pedido::whereDate('created_at', Carbon::today())->get();
        $cuponsHj = DB::table('user_voucher')->whereNotNull('redeemed_at')->count();
        $clientes = DB::table('pedidos')->distinct('user_id')->count('user_id');
        $clientesHJ = DB::table('pedidos')->distinct('user_id')->whereDate('created_at', Carbon::today())->count('user_id');
        $chartPedidosMeses = Pedido::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) ano, MONTH(created_at) mes'))
        ->groupby('ano','mes')
        ->get();
     
       

        foreach($chartPedidosMeses as $mes)
        {
            
            $arrayMes[$mes->ano] = [$mes->mes =>$mes->data];
        }
       
        notify()->success('Cupom criado com sucesso!','Sucesso');
        return view('admin.dashboard')->with(compact('pedidos','clientes','usuariosADM','clientesHJ','pedidosHj','arrecadacaoHJ','usuarios','cupons','cuponsHj','arrayMes'));
    }
}
