<?php

namespace App\Http\Controllers\AuxiliarTerminal\Sesion;

use App\Models\Materia;
use App\Models\Auxiliar;
use App\Models\InicioClase;
use App\Models\Clase;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\AuxiliarTerminal\Base;

class Control extends Base
{    
    public function iniciarClase(Request $request){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $clase_id   = $request->clase_id;
        
        if($auxiliar->accesoClase($clase_id)){
            $clase = Clase::find($clase_id);
            
            if( !($clase->sesionEnCurso()) ){
                if( $clase->siguienteSesion() ){
                    $clase->semana_actual_sesion = $clase->semana_actual_sesion+1;
                    $clase->save();
                    
                    $sesion = $clase->sesionActual();
                    $sesion->iniciar($auxiliar->id);
                    
                    return response()->json(['exito'=>['Clase iniciada con éxito']], 200);
                }
                return response()->json(['error'=>['codigo'=>'2', 'mensaje'=>['No se dispone de nuevas clases']]], 200);
            }
            return response()->json(['error'=>['codigo'=>'1', 'mensaje'=>['La clase ya fue iniciada']]], 200);
        }
    }
}