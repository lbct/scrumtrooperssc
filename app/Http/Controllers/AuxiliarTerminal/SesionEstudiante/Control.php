<?php

namespace App\Http\Controllers\AuxiliarTerminal\SesionEstudiante;

use App\Models\Materia;
use App\Models\Auxiliar;
use App\Models\SesionEstudiante;
use App\Models\Clase;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\AuxiliarTerminal\Base;

class Control extends Base
{    
    public function cambiarAsistencia(Request $request){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $sesion_estudiante_id = $request->sesion_estudiante_id;
        $asistencia_sesion = $request->asistencia_sesion;
        
        if($auxiliar->accesoSesionEstudiante($sesion_estudiante_id)){
            $sesion_estudiante = SesionEstudiante::find($sesion_estudiante_id);
            $sesion_estudiante->asistencia_sesion = $asistencia_sesion;
            $sesion_estudiante->save();
        }
    }
    
    public function cambiarComentario(Request $request){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $sesion_estudiante_id = $request->sesion_estudiante_id;
        $comentario_auxiliar = $request->comentario_auxiliar;
        
        if($auxiliar->accesoSesionEstudiante($sesion_estudiante_id)){
            $sesion_estudiante = SesionEstudiante::find($sesion_estudiante_id);
            $sesion_estudiante->comentario_auxiliar = $comentario_auxiliar;
            $sesion_estudiante->auxiliar_comentario_id = $auxiliar->id;
            $sesion_estudiante->save();
        }
    }
}