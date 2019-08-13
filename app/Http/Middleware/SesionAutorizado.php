<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\Sesion;

class SesionAutorizado
{
    public function handle($request, Closure $next, $role)
    {
        if(Sesion::autorizado($request, $role))
            return $next($request);
        
        return redirect('/login');
    }
}