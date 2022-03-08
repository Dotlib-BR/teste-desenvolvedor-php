<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;

class AuthOnly
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param mixed ...$args
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$args)
    {
        /** @var User $user */
        $user = $request->user();

        if (in_array('Administrador', $args) && $user->type === 'Administrador') {
            return $next($request);
        }

        if (in_array('Cliente', $args) && $user->type === 'Cliente'){
            return $next($request);
        } else {
            throw new UnauthorizedException('Usuário não autorizado');
        }
    }
}
