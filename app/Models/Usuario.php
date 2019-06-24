<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'USUARIO';
    
    public function administrador()
    {
        return $this->hasOne('App\Models\Administrador', 'USUARIO_ID', 'ID');
    }
    
    public function docente()
    {
        return $this->hasOne('App\Models\Docente', 'USUARIO_ID', 'ID');
    }
    
    public function auxiliar()
    {
        return $this->hasOne('App\Models\Auxiliar', 'USUARIO_ID', 'ID');
    }
    
    public function estudiante()
    {
        return $this->hasOne('App\Models\Estudiante', 'USUARIO_ID', 'ID');
    }
    
    public function iniciarSesion()
    {
        return $this->hasMany('App\Models\IniciarSesion', 'USUARIO_ID', 'ID');
    }
    
    public function asignaRol()
    {
        return $this->hasMany('App\Models\AsignaRol', 'USUARIO_ID', 'ID');
    }
    
    public function tieneRol($rol)
    {
        $tiene_rol = false;
        
        $rol = AsignaRol::where("ROL_ID", $rol)
               ->where("USUARIO_ID", $this->ID)
               ->first();
        
        if($rol!=null)
            $tiene_rol = true;
        
        return $tiene_rol;
    }
}
