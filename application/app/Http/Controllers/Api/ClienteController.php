<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Controle\ClienteAtualizaRequest;
use App\Http\Requests\Controle\ClienteRequest;
use App\Services\ClienteService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->clienteService->get();

        return response($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $cliente = $this->clienteService->create($input['nome'], $input['email'], $input['cpf'], $input['password'] ?? null);

            DB::commit();
            return response(['cliente' => $cliente, 'msg' => 'registro criado com sucesso!', 'error' => false]);
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
        $cliente = $this->clienteService->find($id);

        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteAtualizaRequest $request, $id)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $cliente = $this->clienteService->update($id, $input);

            DB::commit();

            return response(['cliente' => $cliente, 'msg' => 'registro atualizado com sucesso!', 'error' => false]);

        } catch (\Exception $e) {
            Log::error($e);
            dd($e);
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
            $cliente = $this->clienteService->find($id);

            if (!isset($cliente->id)) {
                return response(['msg' => 'o registro com este id não foi encontrado', 'error' => true], 500);
            }

            $deletado = $this->clienteService->delete($id);

            return response(['cliente' => $deletado, 'msg' => 'registro deletado com sucesso!', 'error' => false]);

        } catch (\Exception $e) {
            Log::error($e);
            return response(['msg' => 'houve um erro ao excluir o registro', 'error' => true], 500);
        }
    }
}
