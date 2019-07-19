<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;
use App\ItensPedido;
use App\Produto;

class ItensPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pedido)
    {
        return Pedido::where('id', $pedido->id)->with([
            'clientes',
            'descontos', 
            'itensPedidos' => function($query){
                $query->with('produtos')->get();
            }
        ])->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $pedido = Pedido::where(['cliente_id'=>$dados['cliente_id'], 'status'=>1])->first();
        $valor = Produto::select('valorUnt')->where('id', $dados['produto_id'])->first();    
        //Inclui no pedido em aberto(Não finalizado)
        if(!is_null($pedido)){            
            //verifica se existe o produto no carrio e adiciona mais um 
            $where = [
                'pedido_id' => $pedido->id,
                'produto_id' => $dados['produto_id'],
            ];
            
            $itens = ItensPedido::where($where)->first();
            
            if(!empty($itens)){                                
                $qtd = $itens->quantidade + $dados['quantidade'];   
                $subT = $valor->valorUnt * $dados['quantidade'];
                $sub = $itens->subtotal + $subT;                
                $itens->update([
                    'quantidade' => $qtd,
                    'subtotal' => $sub,
                ]); 
                
                $pedido->update([
                    'valor' => $pedido->valor + $subT,
                ]);
                
                return redirect()->route('itens.index', $pedido->id)->with('success', 'Produdo inserido com sucesso');
            }
            
            $dados['pedido_id'] = $pedido->id;            
            $valor = $pedido->valor * $dados['quantidade'];   
            $pedido->update([
                'valor'=>$valor
            ]);          
            $novo = ItensPedido::create($dados);
            if($novo){
                return redirect()->route('itens.index', $pedido->id)->with('success', 'Produdo inserido com sucesso');
            }else{
                return redirect()->route('itens.index', $pedido->id)->with('error', 'Ocorreu um problema na tenatida de inserir o produto');
            }
        }

        try{
            $novoPedido = Pedido::create([
                'cliente_id' => $dados['cliente_id'],
                'data' => date('Y-m-d H:i'),
                'status' => 1,
                'valor'=> $valor->valorUnt * $dados['quantidade'],
            ]);       
            
            $dProduto = [
                'pedido_id' => $novoPedido->id,
                'produto_id' => $dados['produto_id'],
                'quantidade' => $dados['quantidade'],
                'subtotal' => $valor->valorUnt * $dados['quantidade'],
            ];

            ItensPedido::create($dProduto);

            return redirect()->route('itens.index', $novoPedido->id)->with('success', 'Produdo inserido com sucesso');
        }catch(Exception $e){
            return redirect()->route('itens.index',  $novoPedido->id)->with('error', 'Ocorreu um problema na tenatida de inserir o produto'.$e->getMessage());
        }
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        
        $pedido = $request->pedido;
        $produto = $request->produto;
        $quantidade = $request->quantidade;
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
            $dados['quantidade'] = $qtd - $quantidade;
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
}
