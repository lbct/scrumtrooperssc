<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InicioClase extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'inicio_clase';
    
    public function sesion()
    {
        return $this->belongsTo('App\Models\Clase', 'sesion_id');
    }
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'auxiliar_laboratorio_id');
    }
}
