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
        
        $fechas_inscripcion = new FechaInscripcion;
        $fechas_inscripcion->inicio_inscripcion = $inicio_inscripcion;
        $fechas_inscripcion->fin_inscripcion    = $fin_inscripcion;
        $fechas_inscripcion->save();        
        
        return $fechas_inscripcion;
    }
    
    public function borrar(Request $request){
        $fecha_inscripcion_id = $request->fecha_inscripcion_id;
        
        $fechas_inscripcion = FechaInscripcion::find($fecha_inscripcion_id);
        $fechas_inscripcion->delete();        
        
        return $fechas_inscripcion;
    }
}