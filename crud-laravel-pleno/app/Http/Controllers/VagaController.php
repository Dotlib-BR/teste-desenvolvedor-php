<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use Illuminate\Contracts\Support\ValidatedData;

class VagaController extends Controller
{

    public function index()
    {
        $vagas = Vaga::all();
        return response()->json($vagas);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|string',
            'status' => 'required|string',
        ]);
    
        $vaga = Vaga::create($validatedData);
    
        return redirect('/');
    }
    
    public function show(string $id)
    {
        $vaga = Vaga::findOrFail($id);
        return response()->json($vaga);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|in:Ativa,Pausada,Encerrada',
        ]);
    
        $vaga = Vaga::findOrFail($id);
        $vaga->update($validatedData);
        return response()->json($vaga);
    }
    
    public function destroy(string $id)
    {
        $vaga = Vaga::findOrFail($id);
        $vaga->delete();
        return response()->json(null, 204);
    }
}

