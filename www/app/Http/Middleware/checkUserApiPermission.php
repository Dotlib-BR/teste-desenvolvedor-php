<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkUserApiPermission
{
    protected $redirects = [
        'empresa' => 'empresa.home',
        'candidato' => 'candidato.home'
    ];

    protected $route;

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('api')->check()) {
            return response()->json('Você precisa estar autenticado para acessar esse conteúdo', 401);
        }

        if($request->is('api/v1/empresa/*') && Auth::guard('api')->user()->perfil == 'empresa'){
            return $next($request);
        }

        if($request->is('api/v1/candidato/*') && Auth::guard('api')->user()->perfil == 'candidato'){
            return $next($request);
        }

        return response()->json('Você não tem permissão para acessar esse conteúdo', 403);
    }
}
