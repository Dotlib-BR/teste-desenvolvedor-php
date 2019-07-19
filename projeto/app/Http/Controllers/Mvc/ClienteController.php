<?php

namespace App\Http\Controllers\Mvc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Pedido;

class ClienteController extends Controller
{
    public function index(Request $request)
    {  
        $page = $request['limit'] ?? 20;

        $order = $request['order'] ?? null;
        if(is_null($order)){
            $order = 'id';
        }

        $like = $request['where'] ?? null;  
       

        if(auth()->user()->perfil == 1){

            $clientes= Cliente::orderBy($order)
            ->where(function($query) use ($like){
                if ($like[0] != null && !is_null($like)){
                    return $query->where($like[0], 'like', '%'.$like[1].'%');
                }
                return $query;
            })
            ->where('perfil', 2)
            ->paginate($page);                    
        }else{
            $clientes= Cliente::where('id', auth()->user()->id)->get();                     
        }
        return view('clientes.index', compact('clientes'));
    }

    public function show(Request $request, $id)    
    {
        $cliente = Cliente::where('id', $id)->with('pedidos')->first();
        if($cliente){
            $this->authorize('view', $cliente);
            $request->session()->put('cliente', $id);
            return view('clientes.show', compact('cliente'));
        }
        return redirect()->route('clientes')->with('error', 'Cliente não encontrado');
    }    

    public function create()
    {        
        return view('clientes.create');
    }

    public function store(Request $request)
    {        
        $dados = $request->all();
 

        if(isset($dados['id'])) {
           $cliente = Cliente::find($dados['id']);
           $update = $cliente->update($dados);
           if($update) {
                return redirect()->route('clientes.show', $dados['id'])->with('success', 'Cliente atualizado com sucesso');
           } else {
                return redirect()->route('create')->with('error', 'Ocorreu um erro na tentativa de edição do cliente');
           }
        }

        $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:clientes',
            'cpf' => 'required|unique:clientes'            
        ]);

        $dados['perfil'] = 2;
        $dados['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password'
        $novo = Cliente::create($dados);
        if($novo) {
            return redirect()->route('clientes.show', $novo->id)->with('success', 'Cliente inserido com sucesso');
       } else {
            return redirect()->route('clientes')->with('error', 'Ocorreu um erro na tentativa de inclusão do cliente');
       }
        
    }

    public function destroy(Request $request)
    {        
        $sId = $request['id'];
        $id = explode(",", $sId);
        $msgs = [];
        
        foreach($id as $key=>$value){
            $deletar = Cliente::find($value)->delete();
            if(!$deletar){
                
                $msgs[] = "Erro ao tentar deletar o cliente de nº $value";
            }
        }
        if(empty($msgs)){
            $msgs[] = "Cliente(s) deletado(s) com sucesso";
        }
        
        return redirect()->route('clientes')->withErrors(compact('msgs'));
        
    }

}