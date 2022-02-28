<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ( Cadastros::query()->where('cadastroEmail', '=', $email)->count() > 0 ) {
            $usuario = Cadastros::query()->where('cadastroEmail', '=', $email)->get()[0];
            
            if ( password_verify($usuario->cadastroSenha, $senha) ) {
                // Gerando informações no navegador para o usuário
                $request->session()->put([
                    'usuarioLogado' => true,
                    'usuarioAutoridade' => $usuario->cadastroAutoridade,
                    'usuarioId' => $usuario->cadastroId,
                    'usuarioToken' => $usuario->cadastroToken
                ]);

                return redirect()->route('pagina-inicial');
            } else {
                return redirect()->back()->withErrors('Senha inválida.');
            }
        } else {
            return redirect()->back()->withErrors('Login inválido.');
        }
    }
}
