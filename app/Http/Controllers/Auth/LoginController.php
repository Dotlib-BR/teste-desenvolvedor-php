<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ], [
            'email.required'    => 'Por favor, insira o seu e-mail.',
            'email.email'       => 'Por favor, insira um e-mail válido.',
            'password.required' => 'Por favor, insira a sua senha.'
        ]);

        if ($validator->passes()) {
            $credentials = [
                'email'     => $request->email,
                'password'  => $request->password,
            ];

            if (auth()->attempt($credentials, $request->has('remember'))) {
                if (auth()->user()->role == 'admin') {
                    flashToast('success', 'Conectado.');
                    return redirect('/');
                }

                auth()->logout();
                $request->session()->invalidate();

                flashToast('error', 'Você não possui permissão para entrar no painel.');
                return back()->withInput();
            }
        }

        $validator->getMessageBag()->add('email', 'Por favor, verifique o seu e-mal.');
        $validator->getMessageBag()->add('password', 'Por favor, verifique a sua senha.');

        flashToast('error', 'Os dados inseridos não correspondem aos nossos registros.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();

        flashToast('success', 'Desconectado.');
        return redirect('/');
    }
}
