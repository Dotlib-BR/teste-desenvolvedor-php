<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatoAuthenticatedSessionController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/vagas'; // Redirecionar para a lista de vagas após o login

    public function __construct()
    {
        $this->middleware('guest:candidato')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.candidato.login');
    }

    protected function guard()
    {
        return Auth::guard('candidato');
    }
    protected function authenticated(Request $request, $user)
{
    return redirect()->route('vagas.index');
}

}

