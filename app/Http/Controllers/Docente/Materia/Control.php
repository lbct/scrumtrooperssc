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
        
        return response()->json(['exito'=>$docente->materias($gestion_actual->id)], 200);
    }
    
    public function materiasGestion(Request $request, $gestion_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        return response()->json(['exito'=>$docente->materias($gestion_id)], 200);
    }
}