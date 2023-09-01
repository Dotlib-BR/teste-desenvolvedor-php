<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index()
    {
        // Session::flush();
        // Auth::logout();
        // return redirect('login');
        //return view('home.index');
        if (Auth::check()) {
            // O usuário está logado...
            return view('home.index');
       }else{
            return view('auth.login');
       }
    }
}
