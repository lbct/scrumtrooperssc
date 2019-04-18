<?php

namespace App\Classes;

use Illuminate\Http\Request;

class Rol
{
    private $rol;
    
    public function __construct($rol)
    {
        $this->rol = $rol;
    }
    
    public function is(Request $request)
    {
        $rolRequest = $request->cookie('ROL');
        $is         = false;
        
        if( $this->rol == $rolRequest )
            $is = true;
        
        return $is;
    }
    
    public function __toString()
    {
        return $this->rol;
    }
}