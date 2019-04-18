<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionEstudiante extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'SESION_ESTUDIANTE';
    
    public function sesion()
    {
        return $this->belongsTo('App\Models\Sesion', 'SESION_ID');
    }
    
    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante', 'ESTUDIANTE_ID');
    }
    
    public function envioPractica()
    {
        return $this->hasMany('App\Models\EnvioPractica', 'SESION_ESTUDIANTE_ID', 'ID');
    }
}
