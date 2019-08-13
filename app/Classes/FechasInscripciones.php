<?php
namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FechaInscripcion;
use App\Classes\Gestiones;

class FechasInscripciones
{
    public static function fechaActiva()
    {
        $activa = false;
        
        $fecha_actual = Carbon::now()->toDateTimeString();
        $en_rango = FechaInscripcion::where("inicio_inscripcion", "<=", $fecha_actual)
                    ->where("fin_inscripcion", ">=", $fecha_actual)
                    ->first();
        
        if($en_rango!=null)
            $activa = true;
        
        return $activa;
    }
    
    public static function edicionInscripcion()
    {
        $activa = false;
        
        $gestion = Gestiones::GestionActiva();
        
        if($gestion){
            $fecha_actual = Carbon::now()->subMonth(1)->toDateTimeString();
            
            if($gestion->inicio >= $fecha_actual)
                $activa = true;
        }
        
        return $activa;
    }
}