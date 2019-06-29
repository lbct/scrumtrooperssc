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
        } elseif ($dia == 2) {
            $dia_literal = 'Martes';
        } elseif ($dia == 3) {
            $dia_literal = 'Miercoles';
        } elseif ($dia == 4) {
            $dia_literal = 'Jueves';
        } elseif ($dia == 5) {
            $dia_literal = 'Viernes';
        } elseif ($dia == 6) {
            $dia_literal = 'Sabado';
        } elseif ($dia == 7) {
            $dia_literal = 'Domingo';
        }
        
        return $dia_literal;
    }
}