<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudianteClase extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ESTUDIANTE_CLASE';
    
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase', 'CLASE_ID');
    }
    
    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante', 'ESTUDIANTE_ID');
    }
}
