<?php

namespace App\Http\Controllers\AuxiliarLaboratorio\Sesion;

use App\Models\Auxiliar;
use App\Models\Sesion;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Http\Controllers\AuxiliarLaboratorio\Base;
use Carbon\Carbon;

class Control extends Base
{
    public function estudiantes(Request $request, $sesion_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        $sesion = Sesion::find($sesion_id);
        if($sesion && $sesion->enCurso()){
            $estudiantes = $sesion->estudiantes();                
            return $estudiantes;
        }
    }
}