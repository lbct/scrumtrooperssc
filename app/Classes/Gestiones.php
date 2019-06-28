<?php
namespace App\Classes;

use Illuminate\Http\Request;
use App\Models\Gestion;

class Gestiones
{
    public static function gestionActiva()
    {
        $gestion = Gestion::where("activa", true)->first();
        
        return $gestion;
    }
}