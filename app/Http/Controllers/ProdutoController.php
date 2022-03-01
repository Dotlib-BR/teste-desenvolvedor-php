<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {

        $produtos= Produto::get(); //recebe dados do bd
        return view('produto', compact('produtos'));
       
    }

    public function store(Request $request)
    {
        $dados = new Produto;

        $dados->NomeProduto = $request->nomeProduto;
        $dados->CodBarras = $request->cBarras;
        $dados->ValorUnitario = $request->valorU;
        $dados->save(); // salva os dados do formulario no banco
        return redirect('/cadastrarProduto');

    }

    public function show($id){
        $produto = Produto::findOrFail( $id );
        return view('detalhesDoProduto', compact('produto'));
      }

    public function showEdit($id){
        $produto = Produto::findOrFail( $id );
        return view('editarProduto', compact('produto'));
      }

    public function update(Request $request){
        $produto = Produto::findOrFail( $request->id );
        $produto->NomeProduto = $request->nomeProduto;
        $produto->CodBarras = $request->cBarras;
        $produto->ValorUnitario =  $request->valorU;
    
        if( $produto->save() ){
            return redirect('/api/produto');
        }
      } 

    public function destroy($id){
        $produto = Produto::findOrFail( $id );
        if( $produto->delete() ){
            return redirect('/api/produto');
        }
    
      }

}
