<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produto;

class ProdutoController extends Controller
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
        
        $result = Produto::orderBy($order[0], $order[1])
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
            'descricao' => 'required|max:200',
            'codbarras' => 'required|unique:produtos',
            'valorUnt' => 'required|numeric',
        ]);

        $dados = $request->all();

        return Produto::create($dados);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return $produto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $dados = $request->all();
        $produto->update($dados);

        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
    }
}
