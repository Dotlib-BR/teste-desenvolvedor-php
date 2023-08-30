<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatoController extends Controller
{
    /**
     * Mostra uma lista de candidatos.
     */
    public function index()
    {
        $candidatos = Candidato::all();
        return response()->json($candidatos);
    }

    /**
     * Armazena um novo candidato.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos',
            'experiencia_profissional' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'disponibilidade' => 'nullable|string',
        ]);
    
        $candidato = Candidato::create($validatedData);
        return response()->json($candidato, 201);
    }

    /**
     * Mostra os detalhes de um candidato específico.
     */
    public function show(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        return response()->json($candidato);
    }

    /**
     * Atualiza os detalhes de um candidato existente.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos,email,'.$id,
            'experiencia_profissional' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'disponibilidade' => 'nullable|string',
        ]);

        $candidato = Candidato::findOrFail($id);
        $candidato->update($validatedData);
        return response()->json($candidato);
    }

    /**
     * Remove um candidato do sistema.
     */
    public function destroy(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();
        return response()->json(null, 204);
    }
}
