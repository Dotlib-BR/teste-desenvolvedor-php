<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscricao;

class InscricaoAdminController extends Controller
{
    public function index()
    {
        $inscricaos = Inscricao::paginate(20);
        return view('admin.inscricaos.index', compact('inscricaos'));
    }

    public function create()
    {
        return view('admin.inscricaos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vaga_id' => 'required|exists:vagas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'data_inscricao' => 'required|date',
        ]);

        Inscricao::create($validatedData);

        return redirect()->route('admin.inscricaos.index')->with('success', 'Inscrição criada com sucesso.');
    }

    public function show(Inscricao $inscricao)
    {
        return view('admin.inscricaos.show', compact('inscricao'));
    }

    public function edit(Inscricao $inscricao)
    {
        return view('admin.inscricaos.edit', compact('inscricao'));
    }

    public function update(Request $request, Inscricao $inscricao)
    {
        $validatedData = $request->validate([
            'vaga_id' => 'required|exists:vagas,id',
            'candidato_id' => 'required|exists:candidatos,id',
            'data_inscricao' => 'required|date',
        ]);

        $inscricao->update($validatedData);

        return redirect()->route('admin.inscricaos.index')->with('success', 'Inscrição atualizada com sucesso.');
    }

    public function destroy(Inscricao $inscricao)
    {
        $inscricao->delete();
        return redirect()->route('admin.inscricaos.index')->with('success', 'Inscrição excluída com sucesso.');
    }
}
