<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Pedido;

class DeleteController extends Controller
{

    public function deleteCliente($id){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $clienteId = Cliente::find($id);

        if($clienteId->delete()){

            toast('Cliente excluido!','error');


            return redirect()->route('lista.clientes');
        }

    }

    public function deleteProduto($id){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $produtoId = Produto::find($id);

        if($produtoId->delete()){

            toast('Produto excluido!','error');


            return redirect()->route('lista.produtos');
        }

    }

    public function deletePedido($id){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $pedidoId = Pedido::find($id);

        if($pedidoId->delete()){

            toast('Pedido excluido!','error');


            return redirect()->route('lista.pedidos');
        }

    }

    public function deletarClientesSelecionados(Request $request){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $clientesSelecionados = $request->input('deletar');


        for ($i = 0; $i < count($clientesSelecionados); $i++) {

            DB::table('clientes')->delete([
                'id' => $clientesSelecionados[$i],
            ]);
        }

        toast('Clientes selecionados foram excluido!','error');


        return redirect()->route('lista.clientes');


    }



    public function deletarProdutosSelecionados(Request $request){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $produtosSelecionados = $request->input('deletar');


        for ($i = 0; $i < count($produtosSelecionados); $i++) {

            DB::table('produtos')->delete([
                'id' => $produtosSelecionados[$i],
            ]);
        }

        toast('Produtos selecionados foram excluido!','error');


        return redirect()->route('lista.produtos');


    }


    public function deletarPedidosSelecionados(Request $request){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }
    
        $pedidosSelecionados = $request->input('deletar');


        for ($i = 0; $i < count($pedidosSelecionados); $i++) {

            DB::table('pedidos')->delete([
                'id' => $pedidosSelecionados[$i],
            ]);
        }

        toast('Pedidos selecionados foram excluido!','error');


        return redirect()->route('lista.pedidos');


    }



}