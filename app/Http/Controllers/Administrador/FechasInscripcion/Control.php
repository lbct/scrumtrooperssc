<?php
namespace App\Http\Controllers\Administrador\FechasInscripcion;

use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\FechaInscripcion;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function todas(Request $request){
        $fechas_inscripcion = FechaInscripcion::orderBy('inicio_inscripcion', 'desc')
                              ->orderBy('fin_inscripcion', 'desc')
                              ->select('id', 'inicio_inscripcion', 'fin_inscripcion')
                              ->get();
        
        return $fechas_inscripcion;
    }
    
    public function agregar(Request $request){
        $inicio_inscripcion = $request->inicio_inscripcion;
        $fin_inscripcion    = $request->fin_inscripcion;
        
        $validator = Validator::make($request->all(), [
            'inicio_inscripcion' => 'required|date',
            'fin_inscripcion'    => 'required|date',
        ]);
        
        if(!$validator->fails()){
            $fecha_inscripcion = new FechaInscripcion;
            $fecha_inscripcion->inicio_inscripcion = $inicio_inscripcion;
            $fecha_inscripcion->fin_inscripcion    = $fin_inscripcion;
            $fecha_inscripcion->save();        

            return response()->json(['exito'=>["Fecha de Inscripción añadida con éxito."]], 200);
        }
        return response()->json(['error'=>$validator->errors()->all()], 200);
    }
    
    public function borrar(Request $request){
        $fecha_inscripcion_id = $request->fecha_inscripcion_id;
        
        $fecha_inscripcion = FechaInscripcion::find($fecha_inscripcion_id);
        
        if($fecha_inscripcion)
            $fecha_inscripcion->delete();        
        
        return response()->json(['exito'=>["Fecha de Inscripción eliminada con éxito."]], 200);
    }
}