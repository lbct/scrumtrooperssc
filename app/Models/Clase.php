<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'clase';
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'grupo_docente_id');
    }
    
    public function gestion()
    {
        return $this->belongsTo('App\Models\Gestion', 'gestion_id');
    }
    
    public function aula()
    {
        return $this->belongsTo('App\Models\Aula', 'aula_id');
    }
    
    public function horario()
    {
        return $this->belongsTo('App\Models\Horario', 'horario_id');
    }
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'clase_id', 'id');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'clase_id', 'id');
    }
}
