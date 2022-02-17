<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Clientes;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();

        return view('clientes.index', ['clientes' => $clientes]);
    }

    public function create ()
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request)
    {
        if ($request->validated()) {
            Clientes::create($request->all());
            
            return redirect()->route('clientes-index')->with('success', 'Cliente cadastrado com sucesso!');
        }
    }

    public function show($cliente_id)
    {
        $cliente = Clientes::where('id', $cliente_id)->first();
        if (!empty($cliente)) {
            return view('clientes.show', ['cliente' => $cliente]);

        } else {
            return redirect()->route('clientes-index')->with('erro', 'Cliente não encontrado!');
        }
    }

    public function edit($cliente_id)
    {
        $cliente = Clientes::where('id', $cliente_id)->first();
        if (!empty($cliente)) {
            return view('clientes.edit', ['cliente' => $cliente]);

        } else {
            return redirect()->route('clientes-index')->with('erro', 'Cliente não encontrado!');
        }
    }

    public function update(UpdateClienteRequest $request, $cliente_id)
    {   
        if ($request->validated()) {
            $data = [
                'nome' => $request->nome,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'celular' => $request->celular,
                'data_nascimento' => $request->data_nascimento,
                'status' => $request->status,
            ];
            Clientes::where('id', $cliente_id)->update($data);
            
            return redirect()->route('clientes-index')->with('success', 'Cliente alterado com sucesso!');
        }
    }

    public function destroy($cliente_id)
    {
        if (Pedidos::where(['cliente_id' => $cliente_id, 'status' => 1, 'status' => 2])->first()) {
            return redirect()->route('clientes-index')->with('erro', 'Cliente não pode ser deletado pois está em um Pedido Em Aberto ou Pago!');

        } else {
            Clientes::where('id', $cliente_id)->delete();

            return redirect()->route('clientes-index')->with('success', 'Cliente deletado com sucesso!');
        }
    }
}
