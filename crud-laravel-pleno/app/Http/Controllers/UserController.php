<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validar os dados do formulário de registro
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criar o usuário
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Autenticar o usuário automaticamente após o registro
        Auth::login($user);

        // Redirecionar para a página inicial ou para onde você desejar
        return redirect(route('home'));
    }

    public function login(Request $request)
    {
        // Validar os dados do formulário de login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tentar autenticar o usuário
        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida, redirecionar para a página inicial ou para onde você desejar
            return redirect(route('home'));
        } else {
            // Autenticação falhou, redirecionar de volta para a página de login com mensagem de erro
            return redirect()->back()->with('error', 'Credenciais inválidas. Tente novamente.');
        }
    }

    public function logout()
    {
        // Fazer logout do usuário
        Auth::logout();

        // Redirecionar para a página de login ou para onde você desejar
        return redirect(route('login'));
    }
}
