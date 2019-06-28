<?php

namespace App\Models;

use \App\Classes\Gestiones;
use \App\Models\EstudianteClase;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'estudiante';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
    
    public function estudianteClase()
    {
        return $this->hasMany('App\Models\EstudianteClase', 'estudiante_id', 'id');
    }
    
    public function sesionEstudiante()
    {
        return $this->hasMany('App\Models\SesionEstudiante', 'estudiante_id', 'id');
    }
    
    public function inscripcionActual()
    {
        $gestion_actual = Gestiones::gestionActiva();
        
        $materias = EstudianteClase::where("estudiante_id", $this->id)
                    ->join("clase", "clase.id", "=", "estudiante_clase.clase_id")
                    ->where("clase.gestion_id", $gestion_actual->id)
                    ->join("grupo_a_docente", "grupo_a_docente.id", "=", "estudiante_clase.grupo_a_docente_id")
                    ->join("docente", "docente.id", "=", "grupo_a_docente.docente_id")
                    ->join("usuario", "usuario.id", "=", "docente.usuario_id")
                    ->join("grupo_docente", "grupo_docente.id", "=", "clase.grupo_docente_id")
                    ->join("materia", "materia.id", "=", "grupo_docente.materia_id")
                    ->select("clase.id as clase_id", 
                             "nombre_materia",
                             "codigo_materia",
                             "usuario.nombre as nombre_docente",
                             "usuario.apellido as apellido_docente")
                    ->get();
        
        return $materias;
    }
}
