<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Response;

class CheckTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('authorization')) {
            $authorization = $request->header('authorization');
            //apenas para ficar mais facíl de trabalhar eu armazeno em uma variável

            $id = substr($authorization,0,strrpos($authorization,'|'));
            //pego tudo antes do pipe, que é o id do usuário logado que fez a request

            $token = substr($authorization, strpos($authorization, "|") + 1);
            //pego tudo depois do pipe, que é o token do usuário logado que fez a request

            $user = User::find($id);

            if (! is_numeric($id) || $user === null) {//faço uma simples para o id obtido.
                return response()->json('Bad Request', Response::HTTP_BAD_REQUEST);
            }

            if (! $user->api_token === $token) {//se o token for diferente do token que eu tenho no banco do usuario logado
                if ($user->api_token_old === $token) {//verifico se é igual ao token antigo, se for, o token está expirado
                    return response()->json('Token expired', Response::HTTP_UNAUTHORIZED);
                } else {//se não for um token expirado é um token inválido mesmo
                    return response()->json('Invalid Token', Response::HTTP_UNAUTHORIZED);
                }
            }
            //nesse ponto eu sei que tudo deu certo por que o token é exatamente igual ao que o usuário tem no banco.
        } else {
            return response()->json('Bad Request', Response::HTTP_BAD_REQUEST);
            //não veio cabeçalho de autorization
        }

        return $next($request);//Se tudo der certo o código termina aqui.
    }
}
