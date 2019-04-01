<?php

namespace App\Classes;

use Illuminate\Http\Request;
use App\Models\Usuario;

class Rol
{
    private $rol;
    
    public function __construct($rol)
    {
        $this->rol = $rol;
    }
    
    /*public function is(Request $request)
    {
        $rolRequest = $request->cookie('ROL');
        $is         = false;
        
        if( $this->rol == $rolRequest )
            $is = true;
        
        return $is;
    }*/

    public function is(Request $request)
    {
        $usuario = Usuario::find($request->cookie('USUARIO_ID'));
        $contiene_rol = false;
        if($usuario != null){
            $roles = $usuario->asignaRol;
            $index = 0;
            while(!$contiene_rol && sizeof($roles) > $index){
                $contiene_rol = strtolower($roles[$index]->rol->DESCRIPCION) == strtolower($this->rol);
                $index++;
            }
        }
        return $contiene_rol;
    }
    
    public function __toString()
    {
        return $this->rol;
    }
}