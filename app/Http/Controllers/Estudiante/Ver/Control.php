<?php

namespace App\Http\Controllers\Estudiante\Ver;

use App\Models\Usuario;
use App\Models\EstudianteClase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use App\Models\Estudiante;
use App\Models\Periodo;
use App\Models\SesionEstudiante;
use App\Models\Clase;
use App\Models\Sesion;
use App\Models\Gestion;

class Control extends Base
{
    private function getUltimaGestion()
    {
        $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
        return $id_gestion;
    }
    
    //Obtiene la vista de las materias inscritas del Estudiante con sesión iniciada
    public function getMaterias(Request $request)
    {
        if ($this->rol->is($request)) {
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $materias = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                ->select("NOMBRE_MATERIA")
                ->get();

            return view('estudiante.ver.inscripcion')->with('materias', $materias);
        }

        return redirect('login');
    }
    
    //obtiene la vista del formulario para ver el portafolio del estudiante con sesion iniciada
    public function getPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $gestiones = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                         ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                         ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                         ->join("PERIODO", "GESTION.PERIODO_ID", "=", "PERIODO.ID")
                         ->select("GESTION.ID", "GESTION.ANO_GESTION", "PERIODO.DESCRIPCION")
                         ->orderBy("GESTION.ID", "desc")
                         ->get()
                         ->unique("GESTION.ID");
            
            $gestion_actual = $this->getUltimaGestion();
            
            $clases  = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                         ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                         ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                         ->where("GESTION.ID", $gestion_actual)
                         ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                         ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                         ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                         ->select("NOMBRE_MATERIA", "CLASE_ID")
                         ->get();
            
            return view('estudiante.ver.portafolio.materias')
                   ->with('gestiones', $gestiones)
                   ->with('clases', $clases);
        }

        return redirect('login');
    }

    public function materiasPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $paso = $request->paso;
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $gestion_id = $request->gestion;

            $materias = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                        ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                        ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                        ->where("GESTION.ID", $gestion_id)
                        ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                        ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                        ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                        ->select("NOMBRE_MATERIA", "CLASE_ID")
                        ->get();

            return $materias;
        }

        return redirect('login');
    }

    public function postVerPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $clase_id = $request->clase_id;

            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $practicas = SesionEstudiante::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", "SESION_ESTUDIANTE.ID")
                ->join("SESION", "SESION.ID", "=", "SESION_ESTUDIANTE.SESION_ID")
                ->join("CLASE", "CLASE.ID", "=", "SESION.CLASE_ID")
                ->where("CLASE_ID", $clase_id)
                ->select("ENVIO_PRACTICA.ARCHIVO", "SEMANA", "EN_LABORATORIO", "ENVIO_PRACTICA.created_at")
                ->get();
            
            $materia = Clase::where("CLASE.ID", $clase_id)
                ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                ->join("GESTION", "GESTION.ID", "=", "MATERIA.GESTION_ID")
                ->join("PERIODO", "PERIODO.ID", "=", "GESTION.PERIODO_ID")
                ->select("NOMBRE_MATERIA", "ANO_GESTION", "PERIODO.DESCRIPCION", "SEMANA_ACTUAL_SESION")
                ->get()
                ->unique("NOMBRE_MATERIA", "ANO_GESTION", "PERIODO.DESCRIPCION", "SEMANA_ACTUAL_SESION")
                ->first();
            
            $sesiones = SesionEstudiante::where("SESION_ESTUDIANTE.ESTUDIANTE_ID", $estudiante->ID)
                        ->join("SESION", "SESION.ID", "=", "SESION_ESTUDIANTE.SESION_ID")
                        ->where("SESION.CLASE_ID",$clase_id)
                        ->where("SESION.SEMANA","<=",$materia->SEMANA_ACTUAL_SESION)
                        ->select("SESION.ID", "SEMANA", "COMENTARIO_AUXILIAR", "ASISTENCIA_SESION")
                        ->orderBy("SEMANA")
                        ->get();
            
            return view('estudiante.ver.portafolio.semanas')
                ->with('practicas', $practicas)
                ->with('sesiones', $sesiones)
                ->with('materia', $materia);
        }
        return redirect('login');
    }
    
    public function verHorario(Request $request)
    {
        if ($this->rol->is($request)) {

            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;
            $gestion_id = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;

            $estudiante_clase = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)->get();
            $horario = array();
            for ($i = 0; $i < 10; $i++)
            {
                for ($j = 0; $j < 6; $j++)
                {
                    $horario[$i][$j] = null;
                }
            }


            foreach($estudiante_clase as $eclase){
                $clase = Clase::where("CLASE.ID", $eclase->CLASE_ID)
                                ->join("HORARIO", "HORARIO.ID", "=", "CLASE.HORARIO_ID")
                                ->join("AULA", "AULA.ID", "=", "CLASE.AULA_ID")
                                ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                                ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                                ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                                ->select("DIA", "HORA_INICIO", "NOMBRE_AULA", "NOMBRE_MATERIA")
                                ->first();
                $x = -1;
                $y = ($clase->DIA)-1;
                switch ($clase->HORA_INICIO){
                    case "06:45:00":$x=0;break;
                    case "08:15:00":$x=1;break;
                    case "09:45:00":$x=2;break;
                    case "11:15:00":$x=3;break;
                    case "12:45:00":$x=4;break;
                    case "14:15:00":$x=5;break;
                    case "15:45:00":$x=6;break;
                    case "17:15:00":$x=7;break;
                    case "18:45:00":$x=8;break;
                    case "20:15:00":$x=9;break;
                }

                $horario[$x][$y] = $clase;
            }

            //return $horario;
            return view('estudiante.ver.horario')
                    ->with('horario', $horario);
        }

        return redirect('login');
    }
}


           