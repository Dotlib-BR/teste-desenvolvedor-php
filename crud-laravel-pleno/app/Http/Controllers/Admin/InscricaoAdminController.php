<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscricao;

class InscricaoAdminController extends Controller
{
    public function index()
    {
        $inscricoes = Inscricao::paginate(20);
        return view('admin.inscricoes.index', compact('inscricoes'));
    }

    public function create()
    {
        return view('admin.inscricoes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vaga_id' => 'required|exists:vagas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'data_inscricao' => 'required|date',
        ]);

        Inscricao::create($validatedData);

        return redirect()->route('admin.inscricoes.index')->with('success', 'Inscrição criada com sucesso.');
    }

    public function show(Inscricao $inscricao)
    {
        return view('admin.inscricoes.show', compact('inscricao'));
    }

    public function edit(Inscricao $inscricao)
    {
        return view('admin.inscricoes.edit', compact('inscricao'));
    }

    public function update(Request $request, Inscricao $inscricao)
    {
        $validatedData = $request->validate([
            'vaga_id' => 'required|exists:vagas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'data_inscricao' => 'required|date',
        ]);

        $inscricao->update($validatedData);

        return redirect()->route('admin.inscricoes.index')->with('success', 'Inscrição atualizada com sucesso.');
    }

    public function destroy(Inscricao $inscricao)
    {
        $inscricao->delete();
        return redirect()->route('admin.inscricoes.index')->with('success', 'Inscrição excluída com sucesso.');
    }
}
