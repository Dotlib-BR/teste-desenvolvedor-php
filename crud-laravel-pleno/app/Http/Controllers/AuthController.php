<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLogin()
    {
        // No need to check authentication for the login page
        return view('auth.login');
    }

    // Process the login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to the home page
            return redirect()->route('home');
        }

        // Authentication failed, redirect back to the login form with an error message
        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    // Log out
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
