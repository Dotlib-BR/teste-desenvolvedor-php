<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatoAdminController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::paginate(20);
        return view('admin.candidatos.index', compact('candidatos'));
    }

    public function create()
    {
        return view('admin.candidatos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos',
            'experiencia_profissional' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'disponibilidade' => 'nullable|string',
        ]);

        Candidato::create($validatedData);

        return redirect()->route('admin.candidatos.index')->with('success', 'Candidato criado com sucesso.');
    }

    public function show(Candidato $candidato)
    {
        return view('admin.candidatos.show', compact('candidato'));
    }

    public function edit(Candidato $candidato)
    {
        return view('admin.candidatos.edit', compact('candidato'));
    }

    public function update(Request $request, Candidato $candidato)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos,email,' . $candidato->id,
            'experiencia_profissional' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'disponibilidade' => 'nullable|string',
        ]);

        $candidato->update($validatedData);

        return redirect()->route('admin.candidatos.index')->with('success', 'Candidato atualizado com sucesso.');
    }

    public function destroy(Candidato $candidato)
    {
        $candidato->delete();
        return redirect()->route('admin.candidatos.index')->with('success', 'Candidato excluído com sucesso.');
    }
}
