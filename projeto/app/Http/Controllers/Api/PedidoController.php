<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Desconto;
use App\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //paginação
        $page = $request['limit'] ?? 20;

        //ordenação
        $order = $request['order'] ?? null;
        if ($order != null) {
            $order = explode(',', $order);
        }
        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';

        //filtro
        $where = $request['where'] ?? [];

        $like = $request['like'] ?? null;
        if ($like != null) {
            $like = explode(',', $like);
        }
        
        $result = Pedido::orderBy($order[0], $order[1])
            ->where(function($query) use ($like){
                if ($like){
                    return $query->where($like[0], 'like', '%'.$like[1].'%');
                }
                return $query;
            })
            ->where($where)
            ->paginate($page);

        return $result;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pedido)
    {
        $pedido = Pedido::where('id', $pedido)->with([
            'clientes', 
            'itensPedidos' => function($query) {
                $query->with('produtos')->get();
            }
        ])->first();
     
        return $pedido;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update($request->all());
        return $pedido;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();  
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
