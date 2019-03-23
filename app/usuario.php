<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuario';
    
    public function administrador()
    {
        return $this->belongsTo('App\Administrador', 'ID');
    }
    
    public function auxiliar()
    {
        return $this->hasOne('App\Auxiliar', 'ID');
    }
    
    public function docente()
    {
        return $this->hasOne('App\Docente', 'ID');
    }
    
    public function estudiante()
    {
        return $this->hasOne('App\Estudiante', 'ID');
    }
}
