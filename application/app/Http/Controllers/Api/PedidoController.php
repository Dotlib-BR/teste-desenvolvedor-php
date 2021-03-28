<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PedidoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = $this->pedidoService->listarPedidos(20);

        return response($pedidos);
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
            'cliente_id' => 'required|integer',
            // 'quantidade' => 'required|array',
            // 'produto_id' => 'required|array',
        ]);

        $input = $request->all();
        $produtos = [];

        DB::beginTransaction();

        // $produtos = $this->formataArray($input);

        try {
            $pedido = $this->pedidoService->create($input['cliente_id'], $input['produtos'],  $input['cupom_desconto_id'] ?? null);

            DB::commit();
            return response(['pedido' => $pedido, 'msg' => 'registro criado com sucesso!', 'error' => false]);
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
        //
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
        $input = $request->all();

        DB::beginTransaction();

        try {
            $pedido = $this->pedidoService->update($id, $input);

            DB::commit();

            return response(['pedido' => $pedido, 'msg' => 'registro atualizado com sucesso!', 'error' => false]);
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
        //
    }
}
