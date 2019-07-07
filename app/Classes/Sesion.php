<?php
namespace App\Classes;

use App\Classes\Sesion;
use Illuminate\Http\Request;
use App\Models\Usuario;

class Sesion
{
    public static function iniciado(Request $request)
    {
        $iniciado = false;
        $usuario_id = session('usuario_id');
        
        if( $usuario_id )
            $iniciado = true;
        
        return $iniciado;
    }
    
    public static function autorizado(Request $request, $rol_id)
    {
        $autorizado = false;
        
        if( Sesion::iniciado($request) )
        {
            $usuario_id = session('usuario_id');
            $usuario    = Usuario::find($usuario_id);
            
            if($usuario->tieneRol($rol_id))
                $autorizado = true;
        }
        
        return $autorizado;
    }
}