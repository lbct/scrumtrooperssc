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
        
        if( Sesion::iniciado($request) ){
            $usuario_id = session('usuario_id');
            $usuario    = Usuario::find($usuario_id);
            
            if($usuario->tieneRol($rol_id))
                $autorizado = true;
        }
        
        return $autorizado;
    }
    
    public static function rutaRol(Request $request)
    {
        $ruta = '';
        
        if( Sesion::iniciado($request) ){
            $usuario_id = session('usuario_id');
            $usuario    = Usuario::find($usuario_id);
            
            if($usuario->tieneRol(1))
                $ruta = 'administrador';
            else if($usuario->tieneRol(2))
                $ruta = 'docente';
            else if($usuario->tieneRol(3))
                $ruta = 'auxiliarlaboratorio';
            else if($usuario->tieneRol(4))
                $ruta = 'auxiliarterminal';
            else if($usuario->tieneRol(5))
                $ruta = 'estudiante';
        }
        
        return $ruta;
    }
}