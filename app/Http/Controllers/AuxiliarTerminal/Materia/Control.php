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
        
        $materias = $auxiliar->materias($gestion_actual->id);
        
        return $materias;
    }
}