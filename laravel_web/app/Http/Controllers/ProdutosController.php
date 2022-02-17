<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Requests\StoreProdutoRequest;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::all();

        return view('produtos.index', ['produtos' => $produtos]);
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(StoreProdutoRequest $request)
    {
        if ($request->validated()) {
            $request->valor = floatval($request->valor);
            $data = [
                'cod_barras' => $request->cod_barras,
                'nome' => $request->nome,
                'valor' => $request->valor,
                'quantidade' => $request->quantidade,
                'status' => $request->status,
            ];
            Produtos::create($data);

            return redirect()->route('produtos-index')->with('success', 'Produto cadastrado com sucesso!');
        }
    }

    public function show($produto_id)
    {
        $produto = Produtos::where('id', $produto_id)->first();
        if (!empty($produto)) {
            return view('produtos.show', ['produto' => $produto]);

        } else {
            return redirect()->route('produtos-index')->with('erro', 'Produto não encontrado!');
        }
    }

    public function edit($produto_id)
    {
        $produto = Produtos::where('id', $produto_id)->first();
        if (!empty($produto)) {
            return view('produtos.edit', ['produto' => $produto]);

        } else {
            return redirect()->route('produtos-index')->with('erro', 'Produto não encontrado!');
        }
    }

    public function update(UpdateProdutoRequest $request, $produto_id)
    {
        if ($request->validated()) {
            if ($request->quantidade == 0) 
                $status = 0;
            else
                $status = $request->status;

            $request->valor = floatval($request->valor);
            $data = [
                'cod_barras' => $request->cod_barras,
                'nome' => $request->nome,
                'valor' => $request->valor,
                'quantidade' => $request->quantidade,
                'status' => $status,
            ];
            Produtos::where('id', $produto_id)->update($data);

            return redirect()->route('produtos-index')->with('success', 'Produto alterado com sucesso!');
        }   
    }

    public function destroy($produto_id)
    {
        
        if (Pedidos::where(['produto_id' => $produto_id, 'status' => 1, 'status' => 2])->first()) {
            return redirect()->route('produtos-index')->with('erro', 'Produto não pode ser deletado pois está em um Pedido Em Aberto ou Pago!');

        } else {
            Produtos::where('id', $produto_id)->delete();

            return redirect()->route('produtos-index')->with('success', 'Produto deletado com sucesso!');
        }

    }
}
