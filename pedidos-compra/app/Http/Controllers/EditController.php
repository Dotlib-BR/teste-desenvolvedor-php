<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Pedido;
use Alert;
use Auth;

class EditController extends Controller
{

    public function salvarClienteEditado(Request $request, $id)
    {

        if (!auth()->guard()
            ->user()) {
            return redirect('pagina.login');
        }

        $dadosCliente = $request->all();

        $clienteId = Cliente::find($id);

        $alterarCliente = $clienteId->update($dadosCliente);

        if ($alterarCliente) {

            Alert::info('Feito', 'Cliente editado!');


            return redirect()->route('lista.clientes');
        }
    }


    public function salvarProdutoEditado(Request $request, $id)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $dadosProduto = $request->all();

        $produtoId = Produto::find($id);

        $alterarProduto = $produtoId->update($dadosProduto);

        if ($alterarProduto) {

            Alert::info('Feito', 'Produto editado!');


            return redirect()->route('lista.produtos');
        }
    }

    public function salvarPedidoEditado(Request $request, $id)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $dadosPedido = $request->all();

        $pedidoId = Pedido::find($id);

        $alterarPedido = $pedidoId->update($dadosPedido);

        $produtos = $request->input('produtos');

        if ($alterarPedido) {

            DB::table('pedido_produto')->where('pedido_id', $pedidoId->id)->delete();

            for ($i = 0; $i < count($produtos); $i++) {

                DB::table('pedido_produto')->insert([
                    'pedido_id' => $pedidoId->id,
                    'produto_id' => $produtos[$i],
                    'valor_unitario' => DB::table('produtos')->where('id', $produtos[$i])->value('valor_unitario'),

                ]);
            }

            DB::table('pedidos')->where('id', $pedidoId->id)->update(['quantidade_itens' => count($produtos)]);

            Alert::info('Feito', 'Pedido editado!');


            return redirect()->route('lista.pedidos');
        }
    }


    public function alterarStatusPedido(Request $request, $id)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $statusProduto = $request['status'];

        $alterarStatus = DB::table('pedidos')->where('id', $id)->update(['status' => $statusProduto]);

        if ($alterarStatus) {

            return redirect()->route('lista.pedidos');
        }
    }

    public function editarCliente(Request $request, $id)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $cliente = Cliente::find($id);

        return view('editar_cliente', compact('cliente', 'usuario_autenticado_nome'));
    }

    public function editarProduto(Request $request, $id)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $produto = Produto::find($id);

        return view('editar_produto', compact('produto', 'usuario_autenticado_nome'));
    }



    public function editarPedido(Request $request, $id)
    {
        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $pedido = Pedido::find($id);
        $clientes = DB::table('clientes')->get();
        $produtos = DB::table('produtos')->get();

        return view('editar_pedido', compact('pedido', 'clientes', 'produtos', 'usuario_autenticado_nome'));
    }
}
