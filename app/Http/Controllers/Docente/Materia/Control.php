<?php
namespace App\Http\Controllers\Docente\Materia;

use App\Models\Usuario;
use App\Models\Docente;
use App\Classes\Gestiones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function materias(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        return $docente->materias($gestion_actual->id);
    }
    
    public function materiasGestion(Request $request, $gestion_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        return $docente->materias($gestion_id);
    }
}