<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Controle\ProdutoRequest;
use App\Services\ProdutoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    protected $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = $this->produtoService->get();

        return response($produtos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $produto = $this->produtoService->create($input['nome'], (int) $input['cod_barras'], $input['valor'], null, $input['ativo'] ?? 0);

            DB::commit();
            return response(['produto' => $produto, 'msg' => 'registro criado com sucesso!', 'error' => false]);

        } catch (\Exception $e) {
            Log::error($e);
            return response(['msg' => 'houve um erro ao salvar os dados', 'error' => true], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->produtoService->find($id);

        return $produto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $produto = $this->produtoService->update($id, $input);

            DB::commit();

            return response(['produto' => $produto, 'msg' => 'registro atualizado com sucesso!', 'error' => false]);

        } catch (\Exception $e) {
            Log::error($e);

            return response(['msg' => 'houve um erro ao salvar os dados', 'error' => true], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $produto = $this->produtoService->find($id);

            if (!isset($produto->id)) {
                return response(['msg' => 'o registro com este id não foi encontrado', 'error' => true], 500);
            }

            $deletado = $this->produtoService->delete($id);

            return response(['produto' => $deletado, 'msg' => 'registro deletado com sucesso!', 'error' => false]);

        } catch (\Exception $e) {
            Log::error($e);
            return response(['msg' => 'houve um erro ao excluir o registro', 'error' => true], 500);
        }
    }
}
