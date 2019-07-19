<?php

namespace App\Http\Controllers\Mvc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;
use App\Cliente;
use App\Produto;

class PedidoController extends Controller
{
    public function index(Request $request)
    {        
        $page = $request['limit'] ?? 20;

        $order = $request['order'] ?? null;
        if(is_null($order)){
            $order = 'id';
        }
        
        $like = $request['where'] ?? null; 

        if($like[0] == 'status' ){
            
            $status = [
                1 => "Nao Finalizado", 
                2 => "Em Aberto - Aguardando Pagamento", 
                3 => "Pago", 
                4 => "Cancelado" 
            ];
            
            $like[1] = array_search( ucfirst($like[1]), $status);            
        }

        if(auth()->user()->perfil == 2){
            $pedidos = Pedido::where('cliente_id', auth()->user()->id)->paginate($page);            
            return view('pedidos.index', compact('pedidos'));
        }

        $pedidos = Pedido::orderBy($order)
        ->where(function($query) use ($like){
            if ($like[0] != null && !is_null($like)){
                return $query->where($like[0], 'like', '%'.$like[1].'%');
            } 
            return $query;        
        })        
        ->paginate($page);     

        return view('pedidos.index', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::where('id', $id)->with([
            'clientes', 
            'itensPedidos' => function($query) {
                $query->with('produtos')->get();
            }
        ])->first();
     
        return view('pedidos.show', compact('pedido'));
    }
    public function store(Request $request)
    {
        $dados = $request->all();
        $update = Pedido::find($dados['pedido_id'])->update($dados);
        if($update){
            return \Redirect::back()->with('success','Pedido alterado com sucesso');
        }
    }
   
    public function delete(Request $request)
    {
        $sId = $request['id'];
        $id = explode(",", $sId);
        $msgs = [];
        
        foreach($id as $key=>$value){
            $deletar = Pedido::find($value)->delete();
            if(!$deletar){
                
                $msgs[] = "Erro ao tentar deletar o pedido de nº $value";
            }
        }
        if(empty($msgs)){
            $msgs[] = "Pedido(s) deletado(s) com sucesso";
        }
        return redirect()->back()->withErrors(compact('msgs'));
    }    

}
