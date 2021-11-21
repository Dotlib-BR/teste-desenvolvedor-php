<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckdAccess
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
        if(auth()->check()){
            return $next($request);
        }
        dd('Acesso negado, você não está logado no sistema');
    }
}
