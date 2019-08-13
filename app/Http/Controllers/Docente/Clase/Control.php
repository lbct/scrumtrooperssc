<?php
namespace App\Http\Controllers\Docente\Clase;

use App\Models\Usuario;
use App\Models\Docente;
use App\Classes\Gestiones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{    
    public function clasesGestion(Request $request, $gestion_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        return $docente->clases($gestion_id);
    }
}