<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoDocente extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'GRUPO_DOCENTE';
    
    public function materia()
    {
        return $this->belongsTo('App\Models\Materia', 'MATERIA_ID');
    }
    
    public function grupoADocente()
    {
        return $this->hasMany('App\Models\GrupoADocente', 'GRUPO_DOCENTE_ID', 'ID');
    }
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'GRUPO_DOCENTE_ID', 'ID');
    }
}
