<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use App\Models\Cadastros;
use Exception;

class StatusAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Autenticação feita por mim
        if (! $request->expectsJson()) {
            if($request->session()->get('logado') !== null && $request->session()->get('logado') == 'true' ) {
                $usuario_id = $request->session()->get('usuario_id');
                $usuario_token = $request->session()->get('usuario_token');
    
                // $query = Cadastros::where('cadastroId', '=', $usuario_id);
    
                if (Cadastros::where('cadastroId', '=', $usuario_id)->exists() ) {
                    if (Cadastros::where('cadastroId', '=', $usuario_id)->get('cadastroToken') === $usuario_token) {
                        // Usuário está autenticado
                        return $next($request);
    
                    } else {
                        $request->session()->flush();
                        return redirect('/login')->withErrors('Dados de login incompatíveis. Logue novamente, por favor');
                    }
    
                } else {
                    $request->session()->flush();
                    return redirect('/login')->withErrors('Dados de login incompatíveis. Logue novamente, por favor');
                }
            }
        }
        else {
            return route('pagina-login');
        }
    }
}
