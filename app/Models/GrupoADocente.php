<?php

namespace App\Models;

use App\Models\GrupoDocente;
use Illuminate\Database\Eloquent\Model;

class GrupoADocente extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'grupo_a_docente';
    
    public function grupoDocente()
    {
        return $this->belongsTo('App\Models\GrupoDocente', 'grupo_docente_id');
    }
    
    public function docente()
    {
        return $this->belongsTo('App\Models\Docente', 'docente_id');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'grupo_a_docente_id', 'id');
    }
    
    public function clases()
    {
        $clases = GrupoDocente::find($this->grupo_docente_id)
                  ->join("clase", "clase.grupo_docente_id", "=", "grupo_docente.id")
                  ->join("aula", "aula.id", "=", "clase.aula_id")
                  ->join("horario", "horario.id", "=", "clase.horario_id")
                  ->select("clase.id as id", "materia_id", "grupo_docente_id", "detalle_grupo_docente", "nombre_aula", "dia", "hora_inicio", "hora_fin")
                  ->get();
        
        return $clases;
    }
}
