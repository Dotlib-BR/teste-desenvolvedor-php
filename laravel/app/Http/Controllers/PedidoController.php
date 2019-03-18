<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\model\Pedido;
use App\model\PedidoDetalhe;

class PedidoController extends Controller
{
    function pedidos(Request $request)
    {
        $ordem = $request->input("ordem") ? $request->input("ordem") : ['id', 'desc'];
        $search = $request->input("search") ? $request->input("search") : "";
        return Pedido::with(['cliente', 'pedidoDetalhe.produto'])->orderBy($ordem[0], $ordem[1])->paginate(20)->toJson();
    }

    function storage(Request $request)
    { 
        
        try{

            $validator = Validator::make($request->all(), [
                'cliente_id' => 'required|numeric',
            ]);
    
    
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            if ($request->input("pedido_id")) {
                $pedido  = Pedido::find($request->input("pedido_id"));
            } else {
                $pedido = new Pedido();
            }
    
            $pedido->cliente_id = $request->input("cliente_id");
            if (!$pedido->save()) {
                throw new \Exception("Não foi possivel salvar pedido!");
            }

            return response()->json([
                'message' => "Pedido salvo com sucesso!",
                'success' => true,
                'pedido'=> Pedido::where("id","=",$pedido->id)->with(['cliente','pedidoDetalhe'])->get()->first()
                 
            ]);

        }catch(\Exception $ex){

            return response()->json([
                'message' => $ex->getMessage(),
                'success' => false
            ]);
        }
       
    }

    function pedidoProduto(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                'pedido_id' => 'required|numeric',
                'produto_id' => 'required|numeric',
                'quantidade' => 'required|numeric',
                'desconto' => 'required|numeric|max:99|min:0',
            ]);
    
    
       

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }


            if ($request->input("pedido_detalhe_id")) {
                $pedidoDetalhe  = PedidoDetalhe::find($request->input("pedido_detalhe_id"));
            } else {
                $pedidoDetalhe = new PedidoDetalhe();
                $pedidoDetalhe->pedido_id = $request->input("pedido_id");
            }
    
            $pedidoDetalhe->quantidade = $request->input("quantidade");
            $pedidoDetalhe->produto_id = $request->input("produto_id");
            $pedidoDetalhe->desconto = $request->input("desconto");

            if (!$pedidoDetalhe->save()) {
                throw new \Exception("Não foi possivel incluir produto!");
            }

            return response()->json([
                'message' => "Produto incluido com sucesso!",
                'success' => true,
                'pedido'=> Pedido::where("id","=",$pedidoDetalhe->pedido_id)->with(['cliente','pedidoDetalhe.produto'])->get()->first()
                 
            ]);

        }catch(\Exception $ex){
       
            return response()->json([
                'message' => $ex->getMessage(),
                'success' => false
            ]);
        }

    }

    function pagamento(Request $request){
        try{

            $validator = Validator::make($request->all(), [
                'pedido_id' => 'required|numeric',
                'status' => 'required|in:pago,cancelado,aberto',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $pedido = Pedido::find($request->input("pedido_id"));

            if(!$pedido){
                throw new \Exception("Pedido não encontrado!");
            }
            $status = $request->input('status') =="pago" ? "cancelado" : "pago";
            $pedido->status = $status;
            if(!$pedido->save()){
                throw new Exception("Não foi possivel atualizar o status do pedido".$status);
            }

            return response()->json([
                'message' => "Produto incluido com sucesso!",
                'success' => true,                 
            ]);

        }catch(\Exception $ex){

            return response()->json([
                'message' => $ex->getMessage(),
                'success' => false
            ]);

        }
    }

}
