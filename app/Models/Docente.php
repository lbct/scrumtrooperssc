<?php

namespace App\Models;

use App\Models\GrupoADocente;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'docente';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
    
    public function grupoADocente()
    {
        return $this->hasMany('App\Models\GrupoADocente', 'docente_id', 'id');
    }
    
    public function materias($gestion_id)
    {
        $materias = GrupoADocente::where('docente_id', $this->id)
                    ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_a_docente.grupo_docente_id')
                    ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                    ->where('materia.gestion_id', $gestion_id)
                    ->select("grupo_docente_id as id", "nombre_materia")
                    ->get();
        
        return $materias;
    }
}
