<?php

namespace App\Http\Controllers\Mvc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Pedido;
use App\ItensPedido;
use App\Desconto;

class ItensPedidoController extends Controller
{
    public function index($pedido)
    {        
        $pedido = Pedido::where('id', $pedido)->with([
            'clientes',
            'descontos', 
            'itensPedidos' => function($query){
                $query->with('produtos')->get();
            }
        ])->first();
                
        return view('itens.index', compact('pedido')) ;
    }
    
    public function adicionar(Request $request)
    {           
        $produto = $request->all();               
        $cliente = auth()->user()->id;        
        $pedido = Pedido::where(['cliente_id'=>$cliente, 'status'=>1])->first();
        //Inclui no pedido em aberto(Não finalizado)
        if(!is_null($pedido)){            
            //verifica se existe o produto no carrio e adiciona mais um 
            $where = [
                'pedido_id' => $pedido->id,
                'produto_id' => $produto['produto_id'],
            ];
            $itens = ItensPedido::where($where)->first();
            
            if(!empty($itens)){                
                $valor = Produto::select('valorUnt')->where('id', $produto['produto_id'])->first();            
                $qtd = $itens->quantidade + 1;                
                $sub = $itens->subtotal + $valor->valorUnt;                
                $itens->update([
                    'quantidade' => $qtd,
                    'subtotal' => $sub,
                ]); 

                $pedido->update([
                    'valor' => $pedido->valor + $valor->valorUnt,
                ]);
                return redirect()->route('itens.index', $pedido->id)->with('success', 'Produdo inserido com sucesso');
            }
            $produto['pedido_id'] = $pedido->id;            
            $valor = $pedido->valor + $produto['subtotal'];   
            $pedido->update([
                'valor'=>$valor
            ]);          
            $novo = ItensPedido::create($produto);
            if($novo){
                return redirect()->route('itens.index', $pedido->id)->with('success', 'Produdo inserido com sucesso');
            }else{
                return redirect()->route('itens.index', $pedido->id)->with('error', 'Ocorreu um problema na tenatida de inserir o produto');
            }
        }

        try{
            $novoPedido = Pedido::create([
                'cliente_id' => $cliente,
                'data' => date('Y-m-d H:i'),
                'status' => 1,
                'valor'=> $produto['subtotal'],
            ]);       
            $produto['pedido_id'] = $novoPedido->id;
            ItensPedido::create($produto);
            return redirect()->route('itens.index', $novoPedido->id)->with('success', 'Produdo inserido com sucesso');
        }catch(Exception $e){
            return redirect()->route('itens.index',  $novoPedido->id)->with('error', 'Ocorreu um problema na tenatida de inserir o produto'.$e->getMessage());
        }
    }

    public function deletar(Request $request)
    {        
        $pedido = $request->pedido;
        $produto = $request->produto;
        $item = (boolean)$request->item;        
        
        $wherePedido = [
            'id' => $pedido,
            'status'=>1
        ];
        $ePedido = Pedido::where($wherePedido)->first();        
        
        if(empty($ePedido)){
            return redirect()->route('itens.index',  $pedido)->with('error', 'Não é possível altear um pedido finalizado');
        }
        $where = [
            'produto_id' => $produto,
            'pedido_id' => $pedido,
        ];       
        $itensPedido = ItensPedido::where($where)->orderBy('id', 'desc')->first();        

        if(empty($itensPedido)){
            return redirect()->route('itens.index',  $pedido)->with('error', 'Produto não encontrado no carrinho');
        }

        $qtd = $itensPedido->quantidade;
        
            //Retira o produto do carrinho
        if($qtd<=1 || $item) {
            $subtotal = $itensPedido->subtotal;
            $valor['valor'] = $ePedido->valor - $subtotal;
            Pedido::find($pedido)->update($valor);
            ItensPedido::find($itensPedido->id)->delete();              
        }else{
            //Atualiza a quantida e subvalor
            $valorProd = $itensPedido->subtotal / $qtd;
            $dados['quantidade'] = $qtd - 1;
            $dados['subtotal'] = $itensPedido->subtotal - $valorProd;
            ItensPedido::find($itensPedido->id)->update($dados);

            //Atualiza o valor do pedido
            $valor['valor'] = $ePedido->valor - $valorProd;
            Pedido::find($pedido)->update($valor);
        }
        
        $itens = ItensPedido::where('pedido_id', $pedido)->exists();
        if(!$itens){
            Pedido::find($pedido)->delete();
            return redirect()->route('itens.index',  $pedido)->with('success', 'Iten removido com sucesso');
        }

        return redirect()->route('itens.index',  $pedido)->with('success', 'Iten removido com sucesso');

    }

    public function desconto(Request $request)
    {        
        $desconto = Desconto::where('nome', $request['desconto'])->first();
        
        if(empty($desconto)){
            return redirect()->route('itens.index',  $request['pedido'])->with('error', 'Cupom de desconto inválido');
        }

        $dPedido = Pedido::find($request['pedido']);

        if(!is_null($dPedido->desconto_id)){
            return redirect()->route('itens.index',  $request['pedido'])->with('error', 'Cupom não acumulativo');
        }
        
        $update = [
            'desconto_id' => $desconto->id,
            'valor' => $dPedido->valor - $desconto->valor
        ];
        $update = $dPedido->update($update);

        if($update){
            return redirect()->route('itens.index',  $request['pedido'])->with('success', 'Cupom de desconto válido');
        }
    }

}
