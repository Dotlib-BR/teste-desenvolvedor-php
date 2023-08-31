<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Verifica se a requisição é da API e não está autenticada
        if ($request->is('api/*') && !$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Altere o redirecionamento para a rota "home" em vez da rota "welcome"
        if (! $request->routeIs('home') && ! $request->expectsJson()) {
            return route('home'); // Substitua 'home' pelo nome da rota da página inicial
        }

        return null;
    }
}
