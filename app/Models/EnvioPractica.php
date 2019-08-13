<?php

namespace App\Models;

use App\Models\SesionEstudiante;
use Illuminate\Database\Eloquent\Model;

class EnvioPractica extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'envio_practica';
    
    public function sesionEstudiante()
    {
        return $this->belongsTo('App\Models\SesionEstudiante', 'sesion_estudiante_id');
    }
    
    public function rutaArchivo()
    {
        $sesion_estudiante_id = $this->sesion_estudiante_id;
        $archivo              = $this->archivo;
        
        $ruta = '/'.$sesion_estudiante_id.'/'.$archivo;
        
        return $ruta;
    }
}
