<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvioPractica extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ENVIO_PRACTICA';
    
    public function sesionEstudiante()
    {
        return $this->belongsTo('App\Models\SesionEstudiante', 'SESION_ESTUDIANTE_ID');
    }
}
