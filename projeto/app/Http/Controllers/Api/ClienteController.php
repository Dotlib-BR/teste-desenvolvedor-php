<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
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
        
        $result = Cliente::orderBy($order[0], $order[1])
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
        $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:clientes',
            'cpf' => 'required|unique:clientes'            
        ]);
        
        $dados = $request->all();

        return Cliente::create($dados);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {        
        return ClienteResource::collection($cliente);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {  
        $cliente->update($request->all());
        return ClienteResource::collection($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        return $cliente->delete();
    }
}
