<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionEstudiante extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sesion_estudiante';
    
    public function sesion()
    {
        return $this->belongsTo('App\Models\Sesion', 'sesion_id');
    }
    
    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante', 'estudiante_clase_id');
    }
    
    public function envioPractica()
    {
        return $this->hasMany('App\Models\EnvioPractica', 'sesion_estudiante_id', 'id');
    }
}
