<?php
namespace App\Http\Controllers\Docente\Gestion;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\GrupoDocenteAuxiliar;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function disponibles(Request $request){
        $usuario_id = session('usuario_id');        
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        return $docente->gestiones();
    }
}