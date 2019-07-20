<?php
namespace App\Http\Controllers\Administrador\Estadisticas;

use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Aula;
use App\Models\Clase;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\EstudianteClase;
use App\Models\Gestion;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\Horario;
use App\Models\Materia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\Gestiones;

class Control extends Base
{
    public function getDatos(Request $request){
        
        $gestion_actual = Gestiones::gestionActiva();
        $datos['numero_materias'] =  Materia::where('gestion_id', '=', $gestion_actual->id)->count();
        $datos['numero_docentes'] = Docente::count();
        $datos['numero_estudiantes'] = Estudiante::count();
        $datos['numero_aulas'] = Aula::count();
        
        return $datos;
    }
    
    public function getTablaGrupos(Request $request){

        $datos = [];
        $gestion_actual = Gestiones::gestionActiva();
        $materias = Materia::where('gestion_id', '=', $gestion_actual->id)->get();
        foreach ($materias as $materia) {

            $grupos = GrupoDocente::where('materia_id', '=', $materia->id)->get();

            $datos_grupos['nombre_materia'] = $materia->codigo_materia."-".$materia->nombre_materia;
            $datos_grupos['grupos'] = [];
            $total_inscritos = 0;

            foreach($grupos as $grupo){
                
                $grupoADocente = GrupoADocente::where('grupo_docente_id', '=', $grupo->id)->get();
                $inscritos = 0;
                foreach($grupoADocente as $gad){
                    $inscritos += EstudianteClase::where('grupo_a_docente_id', '=', $gad->id)->count();
                }
                $temp['docentes'] = $grupo->detalle_grupo_docente;
                $temp['inscritos'] = $inscritos;
                $temp['porcentaje'] = 0;
                $temp['style'] = "width: 0%";
                $total_inscritos += $inscritos;

                array_push($datos_grupos['grupos'], $temp);
            }

            for($c = 0; $c < sizeof($datos_grupos['grupos']); $c++){
                if ($total_inscritos > 0){
                    $datos_grupos['grupos'][$c]['porcentaje'] = $datos_grupos['grupos'][$c]['inscritos']/$total_inscritos*100;
                    $datos_grupos['grupos'][$c]['style'] = "width: ".$datos_grupos['grupos'][$c]['porcentaje']."%";
                }
            }

            array_push($datos, $datos_grupos);
        }

        return $datos;
    }

    public function getChartAulas(Request $request){
        $datos = [];
        $count = [];
        $nombres = [];
        $aulas = Aula::get();
        $gestion_actual = Gestiones::gestionActiva();
        foreach($aulas as $aula){
            array_push($count, Clase::where('aula_id', '=', $aula->id)
                                        ->where('gestion_id', '=', $gestion_actual->id)
                                        ->count());
            array_push($nombres, $aula->nombre_aula);
        }
        array_push($datos, $nombres, $count);
        return $datos;
    }

    public function getTablaAulas(){
        $datos = [];
        $datos['aulas'] = [];
        $datos['horas'] = [];
        $datos['fecha'] = date('d-m-y', time());

        $aulas = Aula::get();
        $horas = Horario::get();
        $gestion_actual = Gestiones::gestionActiva();
        //Dia de la Semana
        $date = date('D', time());
        switch($date){
            case "Mon": $date = 1; break;
            case "Tue": $date = 2; break;
            case "Wed": $date = 3; break;
            case "Thu": $date = 4; break;
            case "Fri": $date = 5; break;
            case "Sat": $date = 6; break;
            default; $date = 7; break;
        }

        foreach($aulas as $aula){
            array_push($datos['aulas'], $aula->nombre_aula);
        }

        foreach($horas as $hora){
            $temp = [];
            array_push($temp, $hora->hora_inicio);
            foreach($aulas as $aula){    
                $clase = Clase::where('dia', '=', $date)
                        ->where('horario_id', '=', $hora->id)
                        ->where('aula_id', '=', $aula->id)
                        ->where('clase.gestion_id', '=', $gestion_actual->id)
                        ->join('grupo_docente', 'grupo_docente.id', '=','grupo_docente_id')
                        ->join('materia', 'materia.id', '=','materia_id')
                        ->select('nombre_materia')
                        ->first();
                if ($clase != null)
                    array_push($temp, $clase->nombre_materia);
                else 
                    array_push($temp, null);
            }
            array_push($datos['horas'], $temp);
        }

        return $datos;
    }
}