<?php

namespace App\Models;

use \App\Models\GrupoDocente;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'materia';
    
    public function gestion()
    {
        return $this->belongsTo('App\Models\Gestion', 'gestion_id');
    }
    
    public function grupoDocente()
    {
        return $this->hasMany('App\Models\GrupoDocente', 'materia_id', 'id');
    }
    
    public function docentes()
    {
        $docentes = GrupoDocente::where("materia_id", $this->id)
                    ->join("grupo_a_docente", "grupo_a_docente.grupo_docente_id", "=", "grupo_docente.id")
                    ->join("docente", "docente.id", "=", "grupo_a_docente.docente_id")
                    ->join("usuario", "usuario.id", "=", "docente.usuario_id")
                    ->select("grupo_a_docente.id as id", 
                             "nombre as nombre_docente", 
                             "apellido as apellido_docente")
                    ->get();
        
        return $docentes;
    }
}
