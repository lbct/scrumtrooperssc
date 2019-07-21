<?php
namespace App\Classes;

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
}