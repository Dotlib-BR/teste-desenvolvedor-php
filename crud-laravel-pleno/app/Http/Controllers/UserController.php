<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Mostra uma lista de usuários.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Armazena um novo usuário.
     */
    public function store(Request $request)
    {
        $userData = $request->all();
        $user = User::create($userData);
        return response()->json($user, 201);
    }

    /**
     * Mostra os detalhes de um usuário específico.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Atualiza os detalhes de um usuário existente.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $userData = $request->all();
        $user->update($userData);
        return response()->json($user);
    }

    /**
     * Remove um usuário do sistema.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
