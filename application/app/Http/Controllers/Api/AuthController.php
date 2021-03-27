<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login()
    {
        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return Auth::user();
        }
    }
}
