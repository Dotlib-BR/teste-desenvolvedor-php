<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inscricao;

class InscricaoAdminController extends Controller
{
    public function index()
    {
        $inscricoes = Inscricao::paginate(20); // Paginação de 20 itens por página
        return view('admin.inscricoes.index', compact('inscricoes'));
    }

    public function create()
    {
        return view('admin.inscricoes.create');
    }

    public function store(Request $request)
    {
        // Lógica para criar uma nova inscrição
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
        // Lógica para atualizar os dados da inscrição
    }

    public function destroy(Inscricao $inscricao)
    {
        // Lógica para excluir a inscrição
    }
}
