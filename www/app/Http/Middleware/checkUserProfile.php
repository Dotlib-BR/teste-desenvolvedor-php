<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkUserProfile
{
    protected $redirects = [
        'empresa' => 'dashboard.empresa.home',
        'candidato' => 'dashboard.candidato.home'
    ];

    protected $route;

    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('auth.login', $request->tenant);
        }

        $this->route = explode('.', $request->route()->getName());

        if(array_key_exists(Auth::user()->perfil, $this->redirects)){

            if(Auth::user()->perfil == $this->route[1]){
                return $next($request);
            }

        }

        return redirect()->route($this->redirects[Auth::user()->perfil]);
    }
}
