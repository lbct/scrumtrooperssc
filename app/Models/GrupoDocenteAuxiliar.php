<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoDocenteAuxiliar extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'grupo_docente_auxiliar';
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'auxiliar_id');
    }
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'grupo_docente_id');
    }
}
