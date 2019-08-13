<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\Sesion;

class SesionIniciado
{
    public function handle($request, Closure $next)
    {
        if(Sesion::iniciado($request))
            return $next($request);
        
        return redirect('/login');
    }
}