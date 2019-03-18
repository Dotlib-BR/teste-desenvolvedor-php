<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Pedido;

class ClienteController extends Controller
{
    public function getAll()
    {
        return response()->json([
            'status' => 'ok',
            'result' => Cliente::all()
        ]);
    }

    public function get(Cliente $cliente)
    {
        return response()->json([
            'status' => 'ok',
            'result' => $cliente
        ]);        
    }

    public function delete(Cliente $cliente)
    {
        $qtdPedidos = Pedido::where('ClienteId', $cliente->id)->get()->count();
        if ($qtdPedidos > 0)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'O cliente ' . $cliente->Nome . ' não pode ser deletado, pois existem pedidos em seu nome!',
                'result' => $cliente
            ]);
        }

        $cliente->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'O cliente ' . $cliente->Nome . ' foi deletado com sucesso!',
            'result' => $cliente
        ]);
    }

    public function update(Cliente $cliente)
    {
        $validator = validator(request()->all(),
            [
                'Nome' => 'nao_vazio',
                'CPF' => 'nao_vazio'
            ],
            [
                'nao_vazio' => 'O :attribute do cliente não pode ser deixado em branco',
                'CPF.nao_vazio' => 'O CPF do cliente não pode ser deixado em branco'
            ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'result' => $validator->errors()
            ]);
        }

        $cliente->update(request()->all());
        return response()->json([
            'status' => 'ok',
            'message' => 'O cliente ' . $cliente->Nome . ' foi editado com sucesso!',
            'result' => $cliente
        ]);
    }

    public function createNew()
    {
        $validator = validator(request()->all(),
            [
                'Nome' => 'required',
                'CPF' => 'required'
            ],
            [
                'required' => 'O :attribute do cliente é obrigatório',
                'CPF.required' => 'O CPF do cliente é obrigatório'
            ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'result' => $validator->errors()
            ]);
        }

        $newCliente = Cliente::create(request()->all());

        return response()->json([
            'status' => 'ok',
            'message' => 'O cliente ' . $newCliente->Nome . ' foi criado com sucesso!',
            'result' => $newCliente
        ]);
    }
}
