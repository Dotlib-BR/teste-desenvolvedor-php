<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::paginate(20); // Paginação de 20 itens por página
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Lógica para criar um novo usuário
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Lógica para atualizar os dados do usuário
    }

    public function destroy(User $user)
    {
        // Lógica para excluir o usuário
    }
}
