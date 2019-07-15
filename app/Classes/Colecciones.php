<?php
namespace App\Classes;

use Illuminate\Support\Collection;

class Colecciones
{
    public static function diferenciaPorId($todos, $registrados)
    {
        $elementos = collect();
        
        $disponibles = array_udiff($todos->toArray(), $registrados->toArray(),
                                   function ($obj_a, $obj_b) {
                                    return $obj_a['id'] - $obj_b['id'];
                                   });

        foreach($disponibles as $disponible){
            $elementos->push($disponible);
        }
        
        return $elementos;
    }
}