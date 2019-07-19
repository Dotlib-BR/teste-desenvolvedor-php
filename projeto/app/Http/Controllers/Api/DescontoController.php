<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Desconto;

class DescontoController extends Controller
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
        
        $result = Desconto::orderBy($order[0], $order[1])
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
            'nome' => 'required|max:20|unique:descontos',
            'valor' => 'required|between:0,99.99',
            'validade' => 'required|date'
        ]);

        $dados = $request->all();
        $desconto = Desconto::create($dados);
        return $desconto;        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Desconto $desconto)
    {
        return $desconto;
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desconto $desconto)
    {
        $desconto->update($request->all());
        return $desconto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desconto $desconto)
    {
        $desconto->delete();
    }
}
