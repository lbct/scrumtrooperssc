<?php

namespace App\Models;

use App\Models\GrupoDocente;
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
    
    public function esBorrable()
    {
        $borrable = true;
        
        $clase_iniciada = GrupoDocente::where('materia_id', $this->id)
                          ->join('clase', 'clase.grupo_docente_id', '=', 'grupo_docente.id')
                          ->where('clase.semana_actual_sesion', '>', 0)
                          ->first();
        
        if($clase_iniciada)
            $borrable = false;
        
        return $borrable;
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
    
    public function tieneDocente($docente_id)
    {
        $tiene = false;
        $docente = GrupoDocente::where('materia_id', $this->id)
                   ->join('grupo_a_docente', 'grupo_a_docente.grupo_docente_id', '=', 'grupo_docente.id')
                   ->where('grupo_a_docente.docente_id', $docente_id)
                   ->first();
        
        if($docente)
            $tiene = true;
            
        return $tiene;
    }
}
