<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processar o login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida, redirecionar para a página inicial
            return redirect()->route('home');
        }

        // Autenticação falhou, redirecionar de volta ao formulário de login com mensagem de erro
        return redirect()->route('login')->with('error', 'Credenciais inválidas');
    }

    // Fazer logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
