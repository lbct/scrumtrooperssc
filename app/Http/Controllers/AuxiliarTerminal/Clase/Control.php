<?php

namespace App\Http\Controllers\AuxiliarTerminal\Clase;

use App\Models\Materia;
use App\Models\Auxiliar;
use App\Models\GrupoDocente;
use App\Models\Clase;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\AuxiliarTerminal\Base;

class Control extends Base
{
    public function disponibles(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        if($auxiliar->esAuxiliarTerminal($grupo_docente_id)){
            $clases = GrupoDocente::find($grupo_docente_id)
                      ->join('clase', 'clase.grupo_docente_id', '=', 'grupo_docente.id')
                      ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                      ->join('aula', 'aula.id', '=', 'clase.aula_id')
                      ->join('horario', 'horario.id', '=', 'clase.horario_id')
                      ->select('clase.id as id', 'dia', 'horario_id', 'nombre_aula', 'semana_actual_sesion', 'nombre_materia', 'detalle_grupo_docente', 'hora_inicio', 'hora_fin')
                      ->get();
            
            return $clases;
        }
    }
    
    public function informacion(Request $request, $clase_id){        
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        if($auxiliar->accesoClase($clase_id)){
            $clase = Clase::find($clase_id)
                     ->join('grupo_docente', 'grupo_docente.id', '=', 'clase.grupo_docente_id')
                     ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                     ->join('horario', 'horario.id', '=', 'clase.horario_id')
                     ->join('aula', 'aula.id', '=', 'clase.aula_id')
                     ->select('clase.id as id','nombre_materia', 'nombre_aula', 'hora_inicio', 'hora_fin', 'detalle_grupo_docente', 'dia', 'semana_actual_sesion')
                     ->first();
            
            $clase['siguiente_sesion'] = $clase->siguienteSesion();
            $clase['en_curso'] = $clase->sesionEnCurso();
            
            return $clase;
        }
    }
}