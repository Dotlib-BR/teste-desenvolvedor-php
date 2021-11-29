<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // public function redirectTo()
    // {
    //     switch (Auth::user()->perfil) {

    //         case 'candidato':
    //             $this->redirectTo = route('dashboard.candidato.home');
    //             return $this->redirectTo;
    //             break;
    //         case 'empresa':
    //             $this->redirectTo = route('dashboard.empresa.home');
    //             return $this->redirectTo;
    //             break;
    //         default:
    //             return redirect()->route('auth.login');
    //             break;
    //     }

    // }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }
}
