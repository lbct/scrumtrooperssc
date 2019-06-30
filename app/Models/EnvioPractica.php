<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvioPractica extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'envio_practica';
    
    public function sesionEstudiante()
    {
        return $this->belongsTo('App\Models\SesionEstudiante', 'sesion_estudiante_id');
    }
}
