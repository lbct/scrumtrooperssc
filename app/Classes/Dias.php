<?php
namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\FechaInscripcion;

class Dias
{
    public static function literal($dia)
    {
        $dia_literal = '';
        
        if ($dia == 1) {
            $dia_literal = 'Lunes';
        } else if ($dia == 2) {
            $dia_literal = 'Martes';
        } else if ($dia == 3) {
            $dia_literal = 'Miercoles';
        } else if ($dia == 4) {
            $dia_literal = 'Jueves';
        } else if ($dia == 5) {
            $dia_literal = 'Viernes';
        } else if ($dia == 6) {
            $dia_literal = 'Sabado';
        } else if ($dia == 7) {
            $dia_literal = 'Domingo';
        }
        
        return $dia_literal;
    }
}