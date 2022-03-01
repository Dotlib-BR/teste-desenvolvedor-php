<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;

class PedidoController extends Controller
{
    public function index()
    {
    
        $clientes= Cliente::get(); //recebe dados do bd
        $produtos= Produto::get(); //recebe dados do bd
        return view('cadastrarPedido', compact('produtos','clientes'));
       
    }

    public function indexPedidos()
    {

        $pedidos= Pedido::get(); //recebe dados do bd
        
        return view('pedido', compact('pedidos'));
       
    }

    public function store(Request $request)
    {
        $dados = new Pedido;

        $v = Produto::find($request->nmProduto );
        $dados->fk_cliente_id = $request->nmCliente;
        $dados->fk_produto_id = $request->nmProduto;
        $dados->Status = 'Aberto';
        $dados->Quantidade = $request->Qtd;
        $dados->DtPedido = $request->nmData;
        $dados->Total = $request->Qtd * ($v->ValorUnitario);
        $dados->save(); // salva os dados do formulario no banco
        return redirect('/api/pedido');

    }

    public function show($id){
        $pedido = Pedido::findOrFail( $id );
        return view('detalhesDoPedido', compact('pedido'));
      }

    public function showEdit($id){
        $pedido = Pedido::findOrFail( $id );
        return view('editarPedido', compact('pedido'));
      }

    public function update(Request $request){
        $dados = Pedido::findOrFail( $request->id );
        
        $dados->Status = $request->sts;
        
        $dados->save(); // salva os dados do formulario no banco com as novas alterações
        return redirect('/api/pedido');
      } 

    public function destroy($id){
        $pedido = Pedido::findOrFail( $id );
        if( $pedido->delete() ){
            return redirect('/api/pedido');
        }
    
      }


}
