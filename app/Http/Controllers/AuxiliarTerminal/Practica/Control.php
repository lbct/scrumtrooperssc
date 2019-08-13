<?php

namespace App\Http\Controllers\AuxiliarTerminal\Practica;

use App\Models\Materia;
use App\Models\Auxiliar;
use App\Models\Clase;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use App\Http\Controllers\AuxiliarTerminal\Base;

class Control extends Base
{
    public function descargables(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        if($auxiliar->esAuxiliarTerminal($grupo_docente_id)){
            $practica_reciente = Clase::where('grupo_docente_id', $grupo_docente_id)
                                 ->orderBy('semana_actual_sesion', 'desc')
                                 ->first();
            
            $practicas = [];
            
            if($practica_reciente){
                $practicas = Sesion::where('clase_id', $practica_reciente->id)
                             ->where('semana', '<=', $practica_reciente->semana_actual_sesion+1)
                             ->join('guia_practica', 'guia_practica.id', '=', 'sesion.guia_practica_id')
                             ->select('guia_practica_id as id', 'sesion.semana', 'archivo')
                             ->orderBy('semana', 'desc')
                             ->get();
            }

            return $practicas;
        }
    }
}