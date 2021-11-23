<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller
{

    /**
     * FUNCOES QUE MUDARAM DE LOGAR
     */
    public function login()
    {
        return view('auth.login.index');
    }

    public function loginAction(Request $request)
    {
        $data = $request->only([
            'email',
            'password'
        ]);
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'E-mail informado não é válido',
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if ($validation->fails()) {
            return redirect()->route('login')
                ->withErrors($validation)->withInput();
        }

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        } else {
            $validation->errors()->add('password', 'Email e/ou senha errados');
            return redirect()->route('login')
                ->withErrors($validation)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect("/login");
    }

    protected function validation(array $data, array $rules, array $feedback)
    {
        return Validator::make($data, $rules, $feedback);
    }

}
