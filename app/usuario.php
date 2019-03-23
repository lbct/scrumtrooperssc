<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuario';
    
    public function administrador()
    {
        return $this->hasOne('App\Administrador', 'USUARIO_ID', 'ID');
    }
    
    public function docente()
    {
        return $this->hasOne('App\Docnete', 'USUARIO_ID', 'ID');
    }
    
    public function auxiliar()
    {
        return $this->hasOne('App\Auxiliar', 'USUARIO_ID', 'ID');
    }
    
    public function estudiante()
    {
        return $this->hasOne('App\Estudiante', 'USUARIO_ID', 'ID');
    }
    
    public function iniciarSesion()
    {
        return $this->hasMany('App\IniciarSesion', 'USUARIO_ID', 'ID');
    }
    
    public function asignaRol()
    {
        return $this->hasOne('App\AsignaRol', 'USUARIO_ID', 'ID');
    }
}
