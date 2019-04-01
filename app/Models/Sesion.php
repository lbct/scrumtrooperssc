<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'SESION';
    
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase', 'CLASE_ID');
    }
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'AUXILIAR_ID');
    }
    
    public function sesionEstudiante()
    {
        return $this->hasMany('App\Models\SesionEstudiante', 'SESION_ID', 'ID');
    }
}
