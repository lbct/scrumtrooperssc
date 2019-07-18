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
        
        $datos = [];
        array_push($datos, Materia::count());
        array_push($datos, Docente::count());
        array_push($datos, Estudiante::count());
        array_push($datos, Aula::count());
        
        return $datos;
    }
    
    public function getTablaGrupos(Request $request){

        $datos = [];
        $materias = Materia::get();
        foreach ($materias as $materia) {

            $grupos = GrupoDocente::where('materia_id', '=', $materia->id)->get();
            $datos_materia = [];
            array_push($datos_materia, $materia->codigo_materia."-".$materia->nombre_materia);

            foreach($grupos as $grupo){

                $temp = [];
                $nombres = "";
                $inscritos = 0;
                
                $grupoADocente = GrupoADocente::where('grupo_docente_id', '=', $grupo->id)->get();
                $docentes = GrupoADocente::where('grupo_docente_id', '=', $grupo->id)
                                            ->join('docente', 'docente.id', '=', 'docente_id')
                                            ->join('usuario', 'usuario.id', '=', 'usuario_id')
                                            ->select('nombre', 'apellido')
                                            ->get();
                
                foreach($docentes as $docente){
                    $nombres = $nombres." ".$docente->nombre." ".$docente->apellido.",";
                }
                $nombres[0] = '(';
                $nombres[strlen($nombres)-1] = ')';

                
                foreach($grupoADocente as $grupo){
                    $inscritos += EstudianteClase::where('grupo_a_docente_id', '=', $grupo->id)->count();
                }

                array_push($temp, $nombres);
                array_push($temp, $inscritos);
                array_push($datos_materia, $temp);
            }

            array_push($datos, $datos_materia);
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