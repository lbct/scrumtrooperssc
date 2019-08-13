<?php
namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Gestion;

class Gestiones
{
    public static function gestionActiva()
    {
        $gestion = Gestion::where("activa", true)->first();
        
        if(!$gestion){
            $gestion = new Gestion;
            $gestion->id = 0;
        }
            
        return $gestion;
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