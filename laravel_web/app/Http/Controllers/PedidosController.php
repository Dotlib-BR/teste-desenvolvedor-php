<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidosRequest;
use App\Http\Requests\UpdatePedidosRequest;
use App\Models\Clientes;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $pedidos = Pedidos::all();

        return view('pedidos.index', ['pedidos' => $pedidos]);
    }

    public function create()
    {
        $clientes = Clientes::all()->where('status', 1);
        $produtos = Produtos::all()->where('status', 1);

        return view('pedidos.create', ['clientes' => $clientes, 'produtos' => $produtos]);
    }

    public function store(StorePedidosRequest $request)
    {   
        $clientes = Clientes::all()->where('status', 1);
        $produtos = Produtos::all()->where('status', 1);

        if ($request->validated()) {   
            $cliente = Clientes::where('id', $request->cliente)->first();
            $produto = Produtos::where('id', $request->produto)->first();
            
            if (intval($produto->quantidade) >= intval($request->quantidade)) {
                
                

                $valor_total = $request->quantidade * $produto->valor;
                $data = [
                    'cliente_id' => $cliente->id,
                    'produto_id' => $produto->id,
                    'nome_cliente' => $cliente->nome,
                    'email_cliente' => $cliente->email,
                    'cpf_cliente' => $cliente->cpf,
                    'cod_barras_produto' => $produto->cod_barras,
                    'nome_produto' => $produto->nome,
                    'valor_un_produto' => $produto->valor,
                    'quantidade' => $request->quantidade,
                    'valor_total' => $valor_total,
                    'data_pedido' => $request->data_pedido,
                    'status' => 1,
                ];
                if (Pedidos::create($data)) {
                    $nova_quantidade = intval($produto->quantidade) - intval($request->quantidade);
                    Produtos::where('id', $produto->id)->update(['quantidade' => $nova_quantidade]);

                    if ($nova_quantidade == 0) {
                        Produtos::where('id', $produto->id)->update(['status' => 0]);
                    }
                }

                return redirect()->route('pedidos-index')->with('success', 'Pedido cadastrado com sucesso!');
            }
            
            $erro = 'Quantidade escolhida não possui no estoque!';
            return view('pedidos.create', ['clientes' => $clientes, 'produtos' => $produtos, 'erro' => $erro]);
        }
    }

    public function show($pedido_id)
    {
        $pedido = Pedidos::where('id', $pedido_id)->first();
        if (!empty($pedido)) {
            return view('pedidos.show', ['pedido' => $pedido]);

        } else {
            return redirect()->route('pedidos-index')->with('erro', 'Pedidos não encontrado!');
        }
    }

    public function edit($pedido_id)
    {
        $pedido = Pedidos::where('id', $pedido_id)->first();
        if (!empty($pedido)) {
            return view('pedidos.edit', ['pedido' => $pedido]);

        } else {
            return redirect()->route('pedidos-index')->with('erro', 'Pedido não encontrado!');
        }
    }

    public function update(UpdatePedidosRequest $request, $pedido_id)
    {
        if ($request->validated()) {
            $pedido = Pedidos::where('id', $pedido_id)->first();

            if ($request->status == 0) {
                $produto_pedido = Produtos::where('id', $pedido->produto_id)->first();
                $nova_quantidade_produto = $produto_pedido->quantidade + $pedido->quantidade;
                Produtos::where('id', $pedido->produto_id)->update(['quantidade' => $nova_quantidade_produto]);
            }

            $data = [
                'data_pedido' => date('Y-m-d h:m',  strtotime($request->data_pedido)),
                'status' => $request->status,
            ];
            Pedidos::where('id', $pedido_id)->update($data);

            return redirect()->route('pedidos-index')->with('success', 'Pedido alterado com sucesso!');
        }
    }

    public function destroy($pedido_id)
    {
        Pedidos::where('id', $pedido_id)->delete();

        return redirect()->route('pedidos-index')->with('success', 'Pedidos deletado com sucesso!');
    }
}
