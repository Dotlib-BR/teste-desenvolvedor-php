<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscricao;

class InscricaoController extends Controller
{
    public function index()
    {
        $inscricoes = Inscricao::paginate(20);
        return response()->json($inscricoes);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vaga_id' => 'required|exists:vagas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'data_inscricao' => 'required|date',
        ]);

        $inscricao = Inscricao::create($validatedData);
        return response()->json($inscricao, 201);
    }

    public function show(string $id)
    {
        $inscricao = Inscricao::findOrFail($id);
        return response()->json($inscricao);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'vaga_id' => 'required|exists:vagas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'data_inscricao' => 'required|date',
        ]);

        $inscricao = Inscricao::findOrFail($id);
        $inscricao->update($validatedData);
        return response()->json($inscricao);
    }

    public function destroy(string $id)
    {
        $inscricao = Inscricao::findOrFail($id);
        $inscricao->delete();
        return response()->json(null, 204);
    }
}
