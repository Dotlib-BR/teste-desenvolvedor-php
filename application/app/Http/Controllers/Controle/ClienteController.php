<?php

namespace App\Http\Controllers\Controle;

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
        $clientes = $this->clienteService->paginate();

        return view('controle.clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('controle.clientes.create');
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
            return redirect()->route('controle.clientes.index')->with('msg', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('msg', "Erro ao cadastrar")->with('error', true)->withInput();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = $this->clienteService->find($id);

        return view('controle.clientes.create', ['cliente' => $cliente]);
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

            return redirect()->route('controle.clientes.index')->with('msg', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);

            return redirect()->back()->with('msg', "Erro ao cadastrar registro")->with('error', true)->withInput();
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
            $this->clienteService->delete($id);
            return redirect()->route('controle.clientes.index')->with('msg', 'Registro excluido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', "Erro ao excluir registro")->with('error', true);
        }
    }
}
