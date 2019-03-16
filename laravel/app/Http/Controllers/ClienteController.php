<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\model\Cliente;
class ClienteController extends Controller
{
    public function clientes(Cliente $cliente,Request $request){
        $ordem= $request->input("ordem") ? $request->input("ordem") : ['id','desc'];
        $search = $request->input("search") ? $request->input("search") : "" ;
        return $cliente->where('nome',"like","%{$search}%")->orderBy($ordem[0],$ordem[1])->paginate(20)->toJson();
   }

   public function storage(Request $request,Cliente $cliente){
    
    try
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'cpf' => 'required|numeric|digits:11',
        ]);

      
 
        if($validator->fails()) {

            throw new \Exception($validator->errors()->first());
        }
        


        if($request->input('id')){
             $cli = $cliente->find($request->input('id'));
             if(!$cli){
                 throw new \Exception("Produto não encontrado!");
             }
      
            if($cli->email != $request->input("email")){
                $validator = Validator::make($request->all(), [
                    'email' => 'required|unique:clientes|email'
                ]);
            }
            

        }else{
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:clientes|email'
            ]);
            $cli = $cliente;
        }

        

      
 
        if($validator->fails()) {

            throw new \Exception($validator->errors()->first());
        }

        $cli->nome = $request->input("nome") ;
        $cli->cpf = $request->input("cpf");
        $cli->email = $request->input("email");
     
        if(!$cli->save()){
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

public function delete($id,Cliente $cliente){

    try
    {
        $cli = $cliente->find($id);
        if(!$cli){
             throw new \Exception("Produto não encontrado!");
        }

        if(!$cli->delete()){
            throw new \Exception("Não foi possivel excluir o produto!");
        }
        
        return response()->json([
            'message' => "Produto excluido com sucesso!",
            'success' => true
        ]);
    }catch(\Exception $ex){

        switch($ex->getCode()){
            case 23000 :
               $msg = "Cliente não pode ser excluido pois está relacionado a um pedido";
            break;
            default:
               $msg =$ex->getMessage();
            break;
        }

        return response()->json([
            'message' => $msg,
            'success' => false
        ]);
    }
    
}

}
