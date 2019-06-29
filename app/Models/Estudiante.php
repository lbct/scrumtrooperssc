<?php

namespace App\Models;

use \App\Classes\Gestiones;
use \App\Models\EstudianteClase;
use \App\Models\Materia;
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
                    ->join("aula", "aula.id", "=", "clase.aula_id")
                    ->join("horario", "horario.id", "=", "clase.horario_id")
                    ->select("estudiante_clase.id as id",
                             "materia.id as materia_id",
                             "nombre_materia",
                             "codigo_materia",
                             "usuario.nombre as nombre_docente",
                             "usuario.apellido as apellido_docente",
                             "clase.dia as dia",
                             "nombre_aula",
                             "horario_id",
                             "hora_inicio",
                             "hora_fin")
                    ->get();
        
        return $materias;
    }
    
    public function estaInscrito($estudiante_clase_id)
    {
        $gestion_actual = Gestiones::gestionActiva();
        $inscrito = false;
        
        $registro = EstudianteClase::where("estudiante_clase.id", $estudiante_clase_id)
                    ->where("estudiante_id", $this->id)
                    ->first();
        
        if($registro != null)
            $inscrito = true;
        
        return $inscrito;
    }
    
    public function retirar($estudiante_clase_id)
    {
        $registro = EstudianteClase::find($estudiante_clase_id);
        $registro->delete();
    }
    
    public function materiasInscritas()
    {
        $gestion_actual = Gestiones::gestionActiva();
        
        $materias = EstudianteClase::where("estudiante_id", $this->id)
                    ->join("clase", "clase.id", "=", "estudiante_clase.clase_id")
                    ->where("clase.gestion_id", $gestion_actual->id)
                    ->join("grupo_a_docente", "grupo_a_docente.id", "=", "estudiante_clase.grupo_a_docente_id")
                    ->join("grupo_docente", "grupo_docente.id", "=", "clase.grupo_docente_id")
                    ->join("materia", "materia.id", "=", "grupo_docente.materia_id")
                    ->select("materia.id as id",
                             "nombre_materia")
                    ->get();
        
        return $materias;
    }
    
    public function materiasDisponibles()
    {
        $gestion_actual = Gestiones::gestionActiva();
        $materias = Materia::where("gestion_id", $gestion_actual->id)
                    ->select("id", 'nombre_materia')
                    ->get();
        
        $materias_inscritas = $this->materiasInscritas();
        
        $materias_disponibles = array_udiff($materias->toArray(), $materias_inscritas->toArray(),
                                            function ($obj_a, $obj_b) {
                                                return $obj_a['id'] - $obj_b['id'];
                                            });
        
        return $materias_disponibles;
    }
}
