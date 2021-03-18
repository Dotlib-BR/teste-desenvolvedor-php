<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Pedido;
use Alert;
use App\Models\Usuario;


class CreateController extends Controller
{

    public function createCliente(Request $request)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $createCliente = Cliente::create([
            'nome_cliente' => $request['nome_cliente'],
            'cpf' => $request['cpf'],
            'email' => $request['email'],
        ]);

        if ($createCliente) {

            Alert::success('Feito', 'Cliente cadastrado!');


            return redirect()->route('lista.clientes');
        }
    }



    public function createProduto(Request $request)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $createProduto = Produto::create([
            'codigo_barras' => $request['codigo_barras'],
            'nome_produto' => $request['nome_produto'],
            'valor_unitario' => $request['valor_unitario'],
        ]);

        if ($createProduto) {

            Alert::success('Feito', 'Produto cadastrado!');


            return redirect()->route('lista.produtos');
        }
    }



    public function createPedido(Request $request)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $quantidadeItens = count($request['produtos']);

        $createPedido = Pedido::create([
            'data_pedido' => $request['data_pedido'],
            'cliente_id' => $request['cliente_id'],
            'quantidade_itens' => $quantidadeItens,
            'status' => 1,
        ]);

        $produtos = $request->input('produtos');




        if ($createPedido) {

            for ($i = 0; $i < count($produtos); $i++) {

                DB::table('pedido_produto')->insert([
                    'pedido_id' => $createPedido->id,
                    'produto_id' => $produtos[$i],
                    'valor_unitario' => DB::table('produtos')->where('id', $produtos[$i])->value('valor_unitario'),
                ]);
            }



            Alert::success('Feito', 'Pedido cadastrado!');


            return redirect()->route('lista.pedidos');
        }
    }


    public function efetuarCadastroUsuario(Request $request)
    {

    

        $usuarios = Usuario::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        if ($usuarios) {

            Alert::success('Sucesso!', 'Usuário cadastrado, você já pode efetuar o login!');

            return redirect()
                ->route('pagina.login');
        }
    }
}
