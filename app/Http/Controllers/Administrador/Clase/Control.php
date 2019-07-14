<?php
namespace App\Http\Controllers\Administrador\Clase;

use App\Models\Usuario;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\Docente;
use App\Models\FechaInscripcion;
use App\Models\Gestion;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Sesion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function todas(Request $request, $gestion_id){
        $clases = Clase::where('clase.gestion_id', $gestion_id)
                  ->join('aula', 'aula.id', '=', 'clase.aula_id')
                  ->join('grupo_docente', 'grupo_docente.id', '=', 'clase.grupo_docente_id')
                  ->join('materia', 'materia.id', '=', 'grupo_docente.materia_id')
                  ->select('clase.id', 'codigo_materia', 'clase.gestion_id', 'nombre_materia', 'nombre_aula', 'detalle_grupo_docente', 'grupo_docente_id', 'aula_id', 'horario_id', 'materia_id', 'dia', 'semana_actual_sesion')
                  ->get();
        
        return $clases;
    }
    
    public function disponibles(Request $request, $gestion_id, $horario_id, $dia){
        $gestion = Gestion::find($gestion_id);
        
        if($gestion){
            $aulas_ocupadas = Clase::where('horario_id', $horario_id)
                              ->where('dia', $dia)
                              ->where('gestion_id', $gestion_id)
                              ->join('aula', 'aula.id', '=', 'clase.aula_id')
                              ->select('aula_id as id', 'aula.nombre_aula')
                              ->get();
            
            $todas_aulas    = Aula::all();
            
            $aulas_disponibles = array_udiff($todas_aulas->toArray(), $aulas_ocupadas->toArray(),
                                            function ($obj_a, $obj_b) {
                                                return $obj_a['id'] - $obj_b['id'];
                                            });
        
            $aulas = collect();

            foreach($aulas_disponibles as $aula_disponible){
                $aulas->push($aula_disponible);
            }
            
            return $aulas;
        }
    }
    
    public function agregar(Request $request){
        $horario_id = $request->horario_id;
        $dia        = $request->dia;
        $aula_id    = $request->aula_id;
        $grupo_docente_id = $request->grupo_docente_id;
        
        $grupo_docente = GrupoDocente::find($grupo_docente_id);
        $gestion_id    = $grupo_docente->gestion();
        
        $clase_similar = Clase::where('grupo_docente_id', $grupo_docente_id)->first();
        
        $clase = new Clase;
        $clase->horario_id = $horario_id;
        $clase->dia        = $dia;
        $clase->aula_id    = $aula_id;
        $clase->gestion_id = $gestion_id;
        $clase->grupo_docente_id = $grupo_docente_id;
        $clase->save();
        
        if($clase_similar){
            $sesiones = Sesion::where('clase_id', $clase_similar->id)
                        ->get();
            
            foreach($sesiones as $sesion){
                $guia_practica_id = $sesion->guia_practica_id;
                $semana           = $sesion->semana;
                
                $nueva_sesion = new Sesion;
                $nueva_sesion->clase_id         = $clase->id;
                $nueva_sesion->guia_practica_id = $guia_practica_id;
                $nueva_sesion->semana           = $semana;
                $nueva_sesion->save();
            }
        }
        
        return $clase;
    }
    
    public function borrar(Request $request){
        $clase_id = $request->clase_id;
        
        $clase = Clase::find($clase_id);
        if($clase)
            $clase->delete();
    }
}