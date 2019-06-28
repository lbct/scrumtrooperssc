<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'CLASE';
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'GRUPO_DOCENTE_ID');
    }
    
    public function gestion()
    {
        return $this->belongsTo('App\Models\Gestion', 'GESTION_ID');
    }
    
    public function aula()
    {
        return $this->belongsTo('App\Models\Aula', 'AULA_ID');
    }
    
    public function horario()
    {
        return $this->belongsTo('App\Models\Horario', 'HORARIO_ID');
    }
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'CLASE_ID', 'ID');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'CLASE_ID', 'ID');
    }
}
