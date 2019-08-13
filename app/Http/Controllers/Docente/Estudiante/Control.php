<?php
namespace App\Http\Controllers\Docente\Estudiante;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\GrupoADocente;
use App\Models\SesionEstudiante;
use App\Models\EnvioPractica;
use App\Models\EstudianteClase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{    
    public function estudiantes(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoGrupoDocente($grupo_docente_id)){
            $grupo_a_docente = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                               ->where('docente_id', $docente->id)
                               ->first();
            
            return $grupo_a_docente->estudiantes();
        }
    }
    
    public function estudiante(Request $request, $estudiante_clase_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoEstudianteClase($estudiante_clase_id)){
            $sesiones = SesionEstudiante::where('estudiante_clase_id', '=', $estudiante_clase_id)
                        ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                        ->select('sesion_estudiante.id as sesion_estudiante_id', 'asistencia_sesion', 'comentario_auxiliar', 'semana', 'guia_practica_id')
                        ->orderBy('semana', 'desc')
                        ->get();
            
            $sesiones = $sesiones->map(function ($sesion) {
                            $sesion_estudiante_id = $sesion['sesion_estudiante_id'];
                            $sesion['archivos'] = EnvioPractica::where('sesion_estudiante_id', 
                                                                       $sesion_estudiante_id)
                                                  ->select('id', 'en_laboratorio', 'archivo')
                                                  ->get();
                            return $sesion;
                        });
            
            
            $estudiante_clase = EstudianteClase::find($estudiante_clase_id);
            $clase      = $estudiante_clase->datosClase();
            $estudiante = $estudiante_clase->datosEstudiante();
            
            return response()->json(['clase'     =>$clase,
                                     'estudiante'=>$estudiante, 
                                     'sesiones'  =>$sesiones], 200);
        }
    }
}