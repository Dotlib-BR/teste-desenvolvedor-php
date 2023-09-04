<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Mostra uma lista de usuários.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Mostra o formulário para criar um novo usuário.
     */
    public function create()
    {
        return view('admin.add_user');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.users')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Mostra os detalhes de um usuário específico.
     */
    public function show(User $user)
    {
        return view('admin.user_detail', ['user' => $user]);
    }

    /**
     * Mostra o formulário para editar um usuário.
     */
    public function edit(User $user)
    {
        return view('admin.edit_user', ['user' => $user]);
    }

    /**
     * Atualiza um usuário no banco de dados.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove um usuário do banco de dados.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuário excluído com sucesso!');
    }
}
