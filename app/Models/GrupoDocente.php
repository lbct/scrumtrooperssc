<?php

namespace App\Models;

use App\Models\Clase;
use App\Models\Sesion;

use Illuminate\Database\Eloquent\Model;

class GrupoDocente extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'grupo_docente';
    
    public function materia()
    {
        return $this->belongsTo('App\Models\Materia', 'materia_id');
    }
    
    public function grupoADocente()
    {
        return $this->hasMany('App\Models\GrupoADocente', 'grupo_docente_id', 'id');
    }
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'grupo_docente_id', 'id');
    }
    
    public function sesiones()
    {
        $clase = Clase::where('grupo_docente_id', $this->id)
                 ->orderBy('semana_actual_sesion', 'desc')
                 ->first();
        
        return $clase->sesiones();
    }
    
    public function maximaSemana()
    {
        $clases = Clase::where('grupo_docente_id', $this->id)
                  ->orderBy('semana_actual_sesion', 'desc')
                  ->first();
        
        return $clases->maximaSemana();
    }
}
