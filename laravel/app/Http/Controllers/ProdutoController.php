<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Produto;
class ProdutoController extends Controller
{
    public function produtos(Produto $produto,Request $request){
         $search = $request->input("search") ? $request->input("search") : "" ;
         return $produto->where('nome',"like","%{$search}%")->paginate(20)->toJson();
    }
}
