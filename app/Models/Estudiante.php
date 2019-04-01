<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ESTUDIANTE';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'USUARIO_ID');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'ESTUDIANTE_ID', 'ID');
    }
    
    public function sesionEstudiante()
    {
        return $this->hasMany('App\Models\SesionEstudiante', 'ESTUDIANTE_ID', 'ID');
    }
}
