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
        
        $clase = new Clase;
        $clase->horario_id = $horario_id;
        $clase->dia        = $dia;
        $clase->aula_id    = $aula_id;
        $clase->gestion_id = $gestion_id;
        $clase->grupo_docente_id = $grupo_docente_id;
        
        $clase->save();
        
        return $clase;
    }
}