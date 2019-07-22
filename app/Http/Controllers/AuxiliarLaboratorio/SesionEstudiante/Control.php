<?php

namespace App\Http\Controllers\AuxiliarLaboratorio\SesionEstudiante;

use App\Models\Materia;
use App\Models\Auxiliar;
use App\Models\SesionEstudiante;
use App\Models\Clase;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\AuxiliarLaboratorio\Base;

class Control extends Base
{    
    public function cambiarAsistencia(Request $request){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $sesion_estudiante_id = $request->sesion_estudiante_id;
        $asistencia_sesion = $request->asistencia_sesion;
        
        $sesion_estudiante = SesionEstudiante::find($sesion_estudiante_id);
        if($sesion_estudiante){
            $sesion = Sesion::find($sesion_estudiante->sesion_id);
            if($sesion->enCurso()){
                $sesion_estudiante->auxiliar_lista_id = $auxiliar->id;
                $sesion_estudiante->asistencia_sesion = $asistencia_sesion;
                $sesion_estudiante->save();
                return response()->json(['exito'=>['Asitencia cambiada con éxito.']], 200);
            }
            return response()->json(['error'=>['La asistencia no pudo ser registrada ya que la sesión ha finalizado.']], 200);
        }
        return response()->json(['error'=>['La asistencia no pudo ser registrada ya que la sesión ha sido eliminada.']], 200);
    }
}