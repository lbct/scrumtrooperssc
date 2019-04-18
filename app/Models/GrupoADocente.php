<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoADocente extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'GRUPO_A_DOCENTE';
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'GRUPO_DOCENTE_ID');
    }
    
    public function docente()
    {
        return $this->belongsTo('App\Models\Docente', 'DOCENTE_ID');
    }
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'GRUPO_A_DOCENTE_ID', 'ID');
    }
}
