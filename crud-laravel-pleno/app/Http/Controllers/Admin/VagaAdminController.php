<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;

class VagaAdminController extends Controller
{
    public function index()
    {
        $vagas = Vaga::paginate(20); // Paginação de 20 itens por página
        return view('admin.vagas.index', compact('vagas'));
    }

    public function create()
    {
        return view('admin.vagas.create');
    }

    public function store(Request $request)
    {
        // Lógica para criar uma nova vaga
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
        // Lógica para atualizar os dados da vaga
    }

    public function destroy(Vaga $vaga)
    {
        // Lógica para excluir a vaga
    }
}
