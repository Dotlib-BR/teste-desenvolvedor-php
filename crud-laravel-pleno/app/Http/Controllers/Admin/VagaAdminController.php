<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;

class VagaAdminController extends Controller
{
    public function index()
    {
        $vagas = Vaga::paginate(20);
        return view('admin.vagas.index', compact('vagas'));
    }

    public function create()
    {
        return view('admin.vagas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|string|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|string|in:Ativa,Pausada,Encerrada',
        ]);

        Vaga::create($validatedData);

        return redirect()->route('admin.vagas.index')->with('success', 'Vaga criada com sucesso.');
    }

    public function show(Vaga $vaga)
    {
        return view('admin.vagas.show', compact('vaga'));
    }

    public function edit(Vaga $vaga)
    {
        return view('admin.vagas.edit', compact('vaga'));
    }

    public function update(Request $request, Vaga $vaga)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|string|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|string|in:Ativa,Pausada,Encerrada',
        ]);

        $vaga->update($validatedData);

        return redirect()->route('admin.vagas.index')->with('success', 'Dados da vaga atualizados com sucesso.');
    }

    public function destroy(Vaga $vaga)
    {
        $vaga->delete();
        return redirect()->route('admin.vagas.index')->with('success', 'Vaga excluída com sucesso.');
    }
}
