<?php

namespace App\Http\Controllers\Estudiante\Sesion;

use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\GrupoADocente;
use App\Models\EnvioPractica;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\Estudiante\Base;

class Control extends Base
{
    public function cursadas(Request $request, $estudiante_clase_id){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        
        if($estudiante->estaInscrito($estudiante_clase_id)){
            $sesiones = SesionEstudiante::where('estudiante_clase_id', '=', $estudiante_clase_id)
                        ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                        ->select('sesion_estudiante.id as sesion_estudiante_id', 'asistencia_sesion', 'comentario_auxiliar', 'semana')
                        ->get();
            
            $sesiones = $sesiones->map(function ($sesion) {
                            $sesion_estudiante_id = $sesion['sesion_estudiante_id'];
                            $sesion['archivos'] = EnvioPractica::where('sesion_estudiante_id', 
                                                                       $sesion_estudiante_id)
                                                  ->select('id', 'en_laboratorio', 'archivo')
                                                  ->get();
                            return $sesion;
                        });
            
            return $sesiones;
        }
    }
}