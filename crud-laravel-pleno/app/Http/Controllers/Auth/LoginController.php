<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Exibir o formulário de login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida, redirecionar para a página após o login
            return redirect()->intended('/dashboard');
        }

        // Autenticação falhou, redirecionar de volta ao formulário de login com mensagem de erro
        return redirect()->route('login')->with('error', 'Credenciais inválidas');
    }

}
