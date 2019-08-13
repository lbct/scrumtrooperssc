<?php

namespace App\Http\Controllers\AuxiliarLaboratorio\Clase;

use App\Models\Auxiliar;
use App\Models\InicioClase;
use App\Models\Clase;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Classes\Gestiones;

use App\Http\Controllers\AuxiliarLaboratorio\Base;
use Carbon\Carbon;

class Control extends Base
{
    public function disponibles(Request $request){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        $fecha_actual = Carbon::now()->toDateTimeString();
        $gestion_actual = Gestiones::gestionActiva();
        $clases = InicioClase::where('inicio_sesion', '<=', $fecha_actual)
                  ->where('fin_sesion', '>=', $fecha_actual)
                  ->join('sesion', 'sesion.id', '=', 'inicio_clase.sesion_id')
                  ->join('clase', 'clase.id', '=', 'sesion.clase_id')
                  ->where('clase.gestion_id', $gestion_actual->id)
                  ->join('horario', 'horario.id', '=', 'clase.horario_id')
                  ->join('aula', 'aula.id', '=', 'clase.aula_id')
                  ->join('grupo_docente', 'grupo_docente.id', '=', 'clase.grupo_docente_id')
                  ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                  ->select('sesion_id as id', 'nombre_materia', 'nombre_aula', 'horario_id', 'dia', 'detalle_grupo_docente', 'semana', 'clase.grupo_docente_id')
                  ->get();
        
        return $clases;
    }
    
    public function informacion(Request $request, $sesion_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        $sesion = Sesion::find($sesion_id);
        if($sesion && $sesion->enCurso()){
            $gestion_actual = Gestiones::gestionActiva();
            $clase_id = $sesion->clase->id;
            $clase = Clase::where('clase.id', $clase_id)
                     ->where('clase.gestion_id', $gestion_actual->id)
                     ->join('horario', 'horario.id', '=', 'clase.horario_id')
                     ->join('aula', 'aula.id', '=', 'clase.aula_id')
                     ->join('grupo_docente', 'grupo_docente.id', '=', 'clase.grupo_docente_id')
                     ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                     ->select('nombre_materia', 'nombre_aula', 'hora_inicio', 'hora_fin', 'dia', 'detalle_grupo_docente')
                     ->first();

            return $clase;
        }
    }
}