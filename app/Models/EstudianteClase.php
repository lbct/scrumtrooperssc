<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudianteClase extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'estudiante_clase';
    
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase', 'clase_id');
    }
    
    public function grupoADocente()
    {
        return $this->belongsTo('App\Models\GrupoADocente', 'grupo_a_docente_id');
    }
    
    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante', 'estudiante_id');
    }
}
