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
use App\Models\Materia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getDatos(Request $request){
        
        $datos['numero_materias'] =  Materia::count();
        $datos['numero_docentes'] = Docente::count();
        $datos['numero_estudiantes'] = Estudiante::count();
        $datos['numero_aulas'] = Aula::count();
        
        return $datos;
    }
    
    public function getTablaGrupos(Request $request){

        $datos = [];
        $materias = Materia::get();
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
        foreach($aulas as $aula){
            array_push($count, Clase::where('aula_id', '=', $aula->id)->count());
            array_push($nombres, $aula->nombre_aula);
        }
        array_push($datos, $nombres, $count);
        return $datos;
    }
}