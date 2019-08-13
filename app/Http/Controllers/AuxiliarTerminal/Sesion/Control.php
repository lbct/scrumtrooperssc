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
    public function iniciarSesion(Request $request){
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
                return response()->json(['error'=>['No se dispone de nuevas sesiones']], 200);
            }
            return response()->json(['error'=>['La sesion ya fue iniciada']], 200);
        }
    }
    
    public function detenerSesion(Request $request){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $clase_id   = $request->clase_id;
        
        if($auxiliar->accesoClase($clase_id)){
            $clase = Clase::find($clase_id);
            
            if( $clase->sesionEnCurso() ){
                $sesion = $clase->sesionActual();
                $sesion->detener();
                $clase->semana_actual_sesion = $clase->semana_actual_sesion-1;
                $clase->save();

                return response()->json(['exito'=>['Clase cancelada con éxito']], 200);
            }
            return response()->json(['error'=>['No ha sido posible cancelar la sesión ya que esta ha sido cursada.']], 200);
        }
    }
    
    public function disponibles(Request $request, $clase_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        if($auxiliar->accesoClase($clase_id)){
            $clase = Clase::find($clase_id);
            
            $sesiones = $clase->sesionesDisponibles();
            return $sesiones;
        }
    }
    
    public function estudiantes(Request $request, $sesion_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        if($auxiliar->accesoSesion($sesion_id)){
            $sesion = Sesion::find($sesion_id);
            
            if($sesion->accesible()){
                return $sesion->estudiantes();
            }
        }
    }
}