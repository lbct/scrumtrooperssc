<?php

namespace App\Http\Controllers\Estudiante\Practica;

use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\GrupoADocente;
use App\Models\EnvioPractica;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\Estudiante\Base;

class Control extends Base
{
    public function descargables(Request $request, $estudiante_clase_id){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        
        if($estudiante->estaInscrito($estudiante_clase_id)){
            $practicas = SesionEstudiante::where('estudiante_clase_id', $estudiante_clase_id)
                         ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                         ->join('guia_practica', 'guia_practica.id', '=', 'sesion.guia_practica_id')
                         ->select('guia_practica.id', 'sesion.semana', 'guia_practica.archivo')
                         ->orderBy('sesion.semana', 'desc')
                         ->get();
            
            return $practicas;
        }
    }
}