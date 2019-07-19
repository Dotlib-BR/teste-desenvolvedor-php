<?php

namespace App\Http\Controllers\Mvc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $page = $request['limit'] ?? 20;

        $order = $request['order'] ?? null;
        if(is_null($order)){
            $order = 'id';
        }
        
        $like = $request['where'] ?? null; 
        
        $produtos = Produto::orderBy($order)
        ->where(function($query) use ($like){
            if ($like[0] != null && !is_null($like)){
                return $query->where($like[0], 'like', '%'.$like[1].'%');
            } 
            return $query;        
        })        
        ->paginate($page);     

        return view('produtos.index', compact('produtos'));
    }

    public function show($id)
    {
        $produto = Produto::find($id);
        if($produto){
            return view('produtos.show', compact('produto'));
        }   
        return redirect()->route('produtos')->with('error', 'Produto não encontrado');
    }

    public function editar($id)
    {
        $produto = Produto::find($id);        
        if($produto){
            return view('produtos.editar', compact('produto'));
        }   
        return redirect()->route('produtos')->with('error', 'Produto não encontrado');
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        if(isset($dados['id'])) {
           $produto = Produto::find($dados['id']);
           $update = $produto->update($dados);
           if($update) {
                return redirect()->route('produtos')->with('success', 'Produto atualizado com sucesso');
           } else {
                return redirect()->route('produtos')->with('error', 'Ocorreu um erro na tentativa de edição do produto');
           }
        }
        $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'required|max:200',
            'codbarras' => 'required|unique:produtos',
            'valorUnt' => 'required|numeric',
        ]);

        $novo = Produto::create($dados);
        if($novo) {
            return redirect()->route('produtos')->with('success', 'Produto inserido com sucesso');
       } else {
            return redirect()->route('produtos')->with('error', 'Ocorreu um erro na tentativa de inclusão do produto');
       }
        
    }
    public function destroy(Request $request)
    {
        $sId = $request['id'];
        $id = explode(",", $sId);
        $msgs = [];
        
        foreach($id as $key=>$value){
            $deletar = Produto::find($value)->delete();
            if(!$deletar){
                
                $msgs[] = "Erro ao tentar deletar o produto de nº $value";
            }
        }
        if(empty($msgs)){
            $msgs[] = "Produto(s) deletado(s) com sucesso";
        }
        
        return redirect()->route('produtos')->withErrors(compact('msgs'));
        
    }
}
