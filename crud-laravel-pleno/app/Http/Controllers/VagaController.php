<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;

class VagaController extends Controller
{
    /**
     * Mostra uma lista das vagas.
     */
    public function index()
    {
        $vagas = Vaga::all();
        return response()->json($vagas);
    }

    /**
     * Armazena uma nova vaga.
     */
    public function store(Request $request)
    {
        $dadosVaga = $request->all();
        $vaga = Vaga::create($dadosVaga);
        return response()->json($vaga, 201);
    }

    /**
     * Mostra os detalhes de uma vaga específica.
     */
    public function show(string $id)
    {
        $vaga = Vaga::findOrFail($id);
        return response()->json($vaga);
    }

    /**
     * Atualiza os detalhes de uma vaga existente.
     */
    public function update(Request $request, string $id)
    {
        $vaga = Vaga::findOrFail($id);
        $dadosVaga = $request->all();
        $vaga->update($dadosVaga);
        return response()->json($vaga);
    }

    /**
     * Remove uma vaga do sistema.
     */
    public function destroy(string $id)
    {
        $vaga = Vaga::findOrFail($id);
        $vaga->delete();
        return response()->json(null, 204);
    }
}

