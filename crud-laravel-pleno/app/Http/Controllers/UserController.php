<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        Auth::login($user);

        return redirect(route('dashboard')); // Alterado para redirecionar para 'dashboard'
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect(route('dashboard')); // Alterado para redirecionar para 'dashboard'
        } else {
            return redirect()->back()->with('error', 'Credenciais inválidas. Tente novamente.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login')); // Alterado para redirecionar para 'login'
    }
}
