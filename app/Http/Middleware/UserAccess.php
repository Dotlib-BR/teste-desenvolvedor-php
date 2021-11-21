<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() AND auth()->user()->user OR auth()->user()->admin){
            return $next($request);
        }
        dd('Acesso negado, você não é um usuário do sistema');
    }
}
