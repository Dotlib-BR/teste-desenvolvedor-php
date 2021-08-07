<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('cruds.pedidos.index', ['pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();
        return view('cruds.pedidos.create')->with([
            'produtos'=>$produtos,
            'clientes'=>$clientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produtos = $request->input('produtos');
        $quantidades = array();
        $valores = $request->input('quantidade');
        for($i = 0; $i<count($valores);$i++){

            if($valores[$i] != "Quantidade"){
                array_push($quantidades,$valores[$i]);
            }
        }
        $valor = 0;
        $pedido = new Pedido();
        $pedido->cliente_id = $request->input('cliente');
        $pedido->ValorTotal = $valor;
        $pedido->save();
        foreach ($produtos as $produto){
            $prod = Produto::find($produto);
            foreach ($quantidades as $qtd){
                $pedido->produtos()->attach($prod,['quantidade'=>$qtd]);
                $valor+= $prod->Valor * $qtd;
                array_shift($quantidades);
            }
        }
        $pedido->ValorTotal = $valor;

        $pedido->save();
        return redirect()->route('pedido.index')->with('success', "Pedido criado com sucesso.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);
        return view('cruds.pedidos.show')
            ->with([
                'pedido' => $pedido
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $ids = array();
        $quantidades = array();
        foreach ($pedido->produtos as $produto){
            array_push($ids,$produto->id);
            array_push($quantidades,$produto->pivot->quantidade);
        }
        $produtos = Produto::all();
        return view('cruds.pedidos.edit', [
            'pedido' => $pedido,
            'produtos' => $produtos,
            'ids' => $ids,
            'quantidades' => $quantidades
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produtos = $request->input('produtos');
        $quantidades = array();
        $valores = $request->input('quantidade');
        for($i = 0; $i<count($valores);$i++){

            if($valores[$i] != "Quantidade"){
                array_push($quantidades,$valores[$i]);
            }
        }

        $valor = 0;
        $pedido = Pedido::find($id);
        $pedido->produtos()->detach();
        $pedido->ValorTotal = $valor;
        $pedido->save();
        foreach ($produtos as $produto){
            $prod = Produto::find($produto);
            foreach ($quantidades as $qtd){
                $pedido->produtos()->attach($prod,['quantidade'=>$qtd]);
                $valor+= $prod->Valor * $qtd;
                array_shift($quantidades);
                break;
            }
        }
        $pedido->ValorTotal = $valor;

        $pedido->save();
        return redirect()->route('pedido.index')->with('success', "Pedido atualizado com sucesso.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return redirect()->route('pedido.index')->with('success', "Pedido Excluido com sucesso.");
    }
}
