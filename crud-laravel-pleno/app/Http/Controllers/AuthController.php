<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar o formulário de login
    public function showLoginForm()
    {
        // Não é necessário verificar a autenticação para a página de login
        return view('auth.login');
    }

    // Processar o login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida, redirecionar para a página inicial
            return redirect()->route('dashboard'); // Alterado para redirecionar para 'dashboard'
        }

        // Autenticação falhou, redirecionar de volta para o formulário de login com uma mensagem de erro
        return redirect()->back()->withInput()->withErrors(['email' => 'Credenciais inválidas. Tente novamente.']);
    }

    // Fazer logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
