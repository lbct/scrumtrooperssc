<?php

namespace App\Http\Controllers\AuxiliarTerminal\Materia;

use App\Models\Materia;
use App\Models\Auxiliar;
use \App\Classes\Gestiones;
use App\Models\GrupoDocenteAuxiliar;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use Carbon\Carbon;

use App\Http\Controllers\AuxiliarTerminal\Base;

class Control extends Base
{
    public function materias(Request $request){        
        $usuario_id     = session('usuario_id');        
        $auxiliar       = Auxiliar::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $materias = GrupoDocenteAuxiliar::where('auxiliar_id', $auxiliar->id)
                    ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_docente_auxiliar.grupo_docente_id')
                    ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                    ->where('materia.gestion_id', $gestion_actual->id)
                    ->select('grupo_docente_id as id', 'nombre_materia')
                    ->get();
        
        return $materias;
    }
}