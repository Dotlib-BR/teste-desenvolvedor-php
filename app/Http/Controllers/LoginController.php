<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        if(!Auth::validate($credentials)):
            return redirect()->to('login')->withErrors('Acesso Negado! A combinação dos dados informados está incorreta.');
        endif;
        if(Auth::getProvider()->retrieveByCredentials($credentials)->status == TRUE){//valida se o usuário está ativo
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user);
            return $this->authenticated($request, $user);
        } else {
            return redirect()->to('login')->withErrors('Usuário inativo. Por gentileza, aguarde a validação dos seus dados para efetuar o login. Obrigado!');
        }
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
