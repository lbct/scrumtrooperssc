<?php

namespace App\Http\Controllers\Estudiante\Materia;

use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\GrupoADocente;
use App\Models\EstudianteClase;
use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\Estudiante\Base;

class Control extends Base
{
    public function inscritas(Request $request){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();

        return $estudiante->inscripcionActual();
    }
    
    public function retirar(Request $request){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();

        $activa = FechasInscripciones::fechaActiva();
        if($activa){
            $estudiante_clase_id = $request->estudiante_clase_id;

            if( $estudiante->estaInscrito($estudiante_clase_id) ){
                $estudiante->retirar($estudiante_clase_id);
                return response()->json(['exito'=>['Materia retirada con éxito']], 200);
            }
            return response()->json(['error'=>['Materia no Válida']], 200);
        }
        return response()->json(['error'=>['La fecha para retiros de materias ha finalizado']], 200);
    }
    
    public function materiasHabilitadas(Request $request){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        
        $activa = FechasInscripciones::fechaActiva();
        if($activa){
            return response()->json(['exito'=>$estudiante->materiasDisponibles()], 200);
        }
        else
            return response()->json(['error'=>['La fecha para inscripciones de materias ha finalizado']], 200);
    }
    
    public function docentesMateria(Request $request, $materia_id){
        $materia = Materia::find($materia_id);
        return response()->json(['exito'=>$materia->docentes()], 200);
    }
    
    public function clasesMateria(Request $request, $grupo_a_docente_id){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $grupo_a_docente = GrupoADocente::find($grupo_a_docente_id);
        $clases = $grupo_a_docente->clasesLibresEstudiante($estudiante->id);
        
        $clases_mod = collect();
        foreach ($clases as $clase) {
            if($clase['disponible']){
                $dia = Dias::literal($clase->dia);
                $descripcion = $dia.' - '.$clase->hora_inicio.' / '.$clase->hora_fin;
                $clase_mod = ['id'=>$clase->id, 'descripcion'=>$descripcion];
                $clases_mod->push($clase_mod);
            }
        }
        
        return response()->json(['exito'=>$clases_mod], 200);
    }
    
    public function nuevaMateria(Request $request){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $grupo_a_docente_id = $request->grupo_a_docente_id;
        $clase_id           = $request->clase_id;
        
        $activa = FechasInscripciones::fechaActiva();
        if($activa){
            $clase = Clase::find($clase_id);
            
            if($clase->cupoDisponible()){
                $registro = new EstudianteClase;
                $registro->clase_id             = $clase_id;
                $registro->grupo_a_docente_id   = $grupo_a_docente_id;
                $registro->estudiante_id        = $estudiante->id;
                $registro->save();

                return response()->json(['exito'=>['Materia añadida correctamente']], 200);
            }
            return response()->json(['error'=>['Horario no disponible, cupos llenos'], 'codigo'=>2], 200);
        }
        return response()->json(['error'=>['La fecha para inscripciones de materias ha finalizado'], 'codigo'=>1], 200);
    }
    
    public function editarMateria(Request $request){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $estudiante_clase_id = $request->estudiante_clase_id;
        $grupo_a_docente_id  = $request->grupo_a_docente_id;
        $clase_id            = $request->clase_id;
        
        $activa = FechasInscripciones::fechaActiva();
        if($activa){
            if($estudiante->estaInscrito($estudiante_clase_id)){
                $clase = Clase::find($clase_id);
            
                if($clase->cupoDisponibleEstudiante($estudiante->id)){
                    $registro = EstudianteClase::find($estudiante_clase_id);
                    $registro->clase_id             = $clase_id;
                    $registro->grupo_a_docente_id   = $grupo_a_docente_id;
                    $registro->save();
                    return response()->json(['exito'=>['Materia editada correctamente.']], 200);
                }
                return response()->json(['error'=>['Horario no disponible, cupos llenos']], 200);
            }
            return response()->json(['error'=>['No tienes acceso a este registro.']], 200);
        }
        return response()->json(['error'=>['La fecha para inscripciones de materias ha finalizado.']], 200);
    }
}