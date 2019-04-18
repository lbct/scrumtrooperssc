<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoDocenteAuxiliar extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'GRUPO_DOCENTE_AUXILIAR';
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'AUXILIAR_ID');
    }
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'GRUPO_DOCENTE_ID');
    }
}
