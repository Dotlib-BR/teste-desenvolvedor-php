<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\model\Produto;
class ProdutoController extends Controller
{
    public function produtos(Produto $produto,Request $request){
         $ordem= $request->input("ordem") ? $request->input("ordem") : ['id','desc'];
         $search = $request->input("search") ? $request->input("search") : "" ;
         return $produto->where('nome',"like","%{$search}%")->orderBy($ordem[0],$ordem[1])->paginate(20)->toJson();
    }

    public function storage(Request $request,Produto $produto){
    
        try
        {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|max:100',
                'valor' => 'required|numeric',
            ]);

          
     
            if($validator->fails()) {
   
                throw new \Exception($validator->errors()->first());
            }
            
    

            if($request->input('id')){
                 $prod = $produto->find($request->input('id'));
                 if(!$prod){
                     throw new \Exception("Produto não encontrado!");
                 }
            }else{
                $prod = $produto;
            }

            $produto->codBarras = $request->input("codBarras") ? $request->input("codBarras")   :"" ;
            $produto->nome = $request->input("nome");
            $produto->valor = $request->input("valor");
            if(!$produto->save()){
                 throw new \Exception("Não foi possivel salvar produto!");
            }
            

            return response()->json([
                'message' => 'Salvo com sucesso!',
                'success' => true
            ]);

        }catch(\Exception $ex){

            return response()->json([
                'message' => $ex->getMessage(),
                'success' => false
            ]);

        }
       
    }

    public function delete($id,Produto $produto){
    
        try
        {
            $prod = $produto->find($id);
            if(!$prod){
                 throw new \Exception("Produto não encontrado!");
            }

            if(!$prod->delete()){
                throw new \Exception("Não foi possivel excluir o produto!");
            }
            
            return response()->json([
                'message' => "Produto excluido com sucesso!",
                'success' => true
            ]);
        }catch(\Exception $ex){

            switch($ex->getCode()){
                case 23000 :
                   $msg = "Produto não pode ser excluido pois está relacionado a um pedido";
                break;
                default:
                   $msg =$ex->getMessage();
                break;
            }
            return response()->json([
                'message' => $msg ,
                'success' => false
            ]);
        }
        
    }
}
