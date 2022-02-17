<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->Produto = new Produto();
    }

    public function showAllProduto(Request $request){
        return $this->Produto->showAll($request);
    }

    public function showOneProduto($id)
    {
        return $this->Produto->showOne($id);
    }

    public function createProduto(Request $request)
    {
        return $this->Produto->cadastro($request);
    }

    public function updateProduto(Request $request, $id){
        return $this->Produto->atualizar($request, $id);
    }

    public function deleteProduto($id)
    {
        return $this->Produto->deletar($id);
    }
}
