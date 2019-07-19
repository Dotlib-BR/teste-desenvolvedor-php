<?php

namespace App\Http\Controllers\Mvc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Desconto;

class DescontoController extends Controller
{
    public function index(Request $request)
    {        
        $page = $request['limit'] ?? 20;

        $order = $request['order'] ?? null;
        if(is_null($order)){
            $order = 'id';
        }
        
        $like = $request['where'] ?? null; 

        $descontos = Desconto::orderBy($order)
        ->where(function($query) use ($like){
            if ($like[0] != null && !is_null($like)){
                return $query->where($like[0], 'like', '%'.$like[1].'%');
            } 
            return $query;        
        })        
        ->paginate($page);    

        return view('descontos.index', compact('descontos'));
    }

    public function create()
    {
        return view('descontos.create');
    }

    public function show(Desconto $desconto)
    {
        return view('descontos.show', compact('desconto'));
    }
    public function store(Request $request)
    {
        $dados = $request->all(); 

        if(isset($dados['id'])) 
        {
           $desconto = Desconto::find($dados['id']);
           $update = $desconto->update($dados);
           if($update) {
                return redirect()->route('descontos')->with('success', 'Cliente atualizado com sucesso');
           } else {
                return redirect()->route('descontos.create')->with('error', 'Ocorreu um erro na tentativa de edição do cliente');
           }
        }

        $request->validate([
            'nome' => 'required|max:20|unique:descontos',
            'valor' => 'required|between:0,99.99',
            'validade' => 'required|date'
        ]);

        $dados = $request->all();
        $novo = Desconto::create($dados);
        if($novo) {
            return redirect()->route('descontos')->with('success', 'Desconto inserido com sucesso');
       } else {
            return redirect()->route('descontos.create')->with('error', 'Ocorreu um erro na tentativa de inclusão do Desconto
            ');
       }
    }

    public function delete(Request $request)
    {
        $sId = $request['id'];
        $id = explode(",", $sId);
        $msgs = [];
        
        foreach($id as $key=>$value){
            $deletar = Desconto::find($value)->delete();
            if(!$deletar){
                
                $msgs[] = "Erro ao tentar deletar o desconto de nº $value";
            }
        }
        if(empty($msgs)){
            $msgs[] = "Desconto(s) deletado(s) com sucesso";
        }
        
        return redirect()->route('descontos')->withErrors(compact('msgs'));
    }
}
