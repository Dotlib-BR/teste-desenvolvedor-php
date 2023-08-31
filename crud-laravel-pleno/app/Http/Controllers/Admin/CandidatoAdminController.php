<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidato;

class CandidatoAdminController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::paginate(20); // Paginação de 20 itens por página
        return view('admin.candidatos.index', compact('candidatos'));
    }

    public function create()
    {
        return view('admin.candidatos.create');
    }

    public function store(Request $request)
    {
        // Lógica para criar um novo candidato
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
        // Lógica para atualizar os dados do candidato
    }

    public function destroy(Candidato $candidato)
    {
        // Lógica para excluir o candidato
    }
}
