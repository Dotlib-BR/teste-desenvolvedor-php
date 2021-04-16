<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Produto;
use App\Models\Categoria;
use DB;
use Illuminate\Http\RedirectResponse;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
      
        $produtos = Produto::where('destaque','=',0)->where('status_estoque','=','disponivel')->where('quantidade_estoque','>',0)->orderBy('created_at', 'desc')->get();
        
        $destaques = Produto::where('destaque','=',1)->where('status_estoque','=','disponivel')->where('quantidade_estoque','>',0)->orderBy('created_at', 'desc')->get();
        notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
        return view('welcome')->with(compact('produtos','destaques'));
    }

    public function produtos($slug){
        $produto = Produto::where('slug', $slug)->where('status_estoque','=','disponivel')->where('quantidade_estoque','>',0)->first();
        if($produto){
           
            return view('frontend.produtos')->with(compact('produto')); 
        }else{
            return redirect('/');
        }

    }

    public function carrinho(){
            $pagina ="Meu Carrinho de Compras";
            return view('frontend.carrinho-compras')->with(compact('pagina')); 
       

    }

    public function checkout(){
        $pagina ="Checkout";
        return view('frontend.checkout')->with(compact('pagina')); 
   

}
    
}
