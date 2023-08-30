<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscricao;

class InscricaoController extends Controller
{
    /**
     * Mostra uma lista de inscrições.
     */
    public function index()
    {
        $inscricoes = Inscricao::all();
        return response()->json($inscricoes);
    }

    /**
     * Armazena uma nova inscrição.
     */
    public function store(Request $request)
    {
        $dadosInscricao = $request->all();
        $inscricao = Inscricao::create($dadosInscricao);
        return response()->json($inscricao, 201);
    }

    /**
     * Mostra os detalhes de uma inscrição específica.
     */
    public function show(string $id)
    {
        $inscricao = Inscricao::findOrFail($id);
        return response()->json($inscricao);
    }

    /**
     * Atualiza os detalhes de uma inscrição existente.
     */
    public function update(Request $request, string $id)
    {
        $inscricao = Inscricao::findOrFail($id);
        $dadosInscricao = $request->all();
        $inscricao->update($dadosInscricao);
        return response()->json($inscricao);
    }

    /**
     * Remove uma inscrição do sistema.
     */
    public function destroy(string $id)
    {
        $inscricao = Inscricao::findOrFail($id);
        $inscricao->delete();
        return response()->json(null, 204);
    }
}
