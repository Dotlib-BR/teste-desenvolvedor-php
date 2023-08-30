<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatoController extends Controller
{

    public function index()
    {
        $candidatos = Candidato::paginate(20);
        return response()->json($candidatos);
    }
  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos',
        ]);
    
        Candidato::create($validatedData);
    
        return redirect(route('home'));
    }

    public function show(string $id)
    {
        $candidato = Candidato::findOrFail($id);
        return response()->json($candidato);
    }

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
