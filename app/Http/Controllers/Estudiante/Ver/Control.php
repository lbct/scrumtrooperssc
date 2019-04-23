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

class Control extends Base
{
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
                ->select("GESTION.ANO_GESTION")
                ->get()
                ->unique();

            return view('estudiante/formularioPortafolio')
                ->with('gestiones', $gestiones);
        }

        return redirect('login');
    }

    public function postPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $paso = $request->paso;
            if ($paso == 2) {
                $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

                $anio_gestion = $request->gestion;
                $periodos = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                    ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                    ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                    ->where("GESTION.ANO_GESTION", $anio_gestion)
                    ->join("PERIODO", "GESTION.PERIODO_ID", "=", "PERIODO.ID")
                    ->select("DESCRIPCION", "PERIODO_ID")
                    ->get()
                    ->unique();

                return $periodos;
            } else if ($paso == 3) {
                $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

                $anio_gestion = $request->gestion;
                $periodo      = $request->periodo;

                $materias = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                    ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                    ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                    ->where("GESTION.ANO_GESTION", $anio_gestion)
                    ->where("GESTION.PERIODO_ID", $periodo)
                    ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                    ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                    ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                    ->select("NOMBRE_MATERIA", "CLASE_ID")
                    ->get();

                return $materias;
            }
        }

        return redirect('login');
    }

    public function postVerPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $clase_id = $request->materia;

            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $archivo = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION", "SESION.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION_ESTUDIANTE", "SESION_ESTUDIANTE.SESION_ID", "=", "SESION.ID")
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", "ENVIO_PRACTICA.ID")
                ->select("ENVIO_PRACTICA.ARCHIVO")
                ->get()
                ->unique();

            $fecha = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION", "SESION.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION_ESTUDIANTE", "SESION_ESTUDIANTE.SESION_ID", "=", "SESION.ID")
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", "ENVIO_PRACTICA.ID")
                ->select("ENVIO_PRACTICA.LUGAR")
                ->get()
                ->unique();

            $lugar = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION", "SESION.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION_ESTUDIANTE", "SESION_ESTUDIANTE.SESION_ID", "=", "SESION.ID")
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", "ENVIO_PRACTICA.ID")
                ->select("ENVIO_PRACTICA.LUGAR")
                ->get()
                ->unique();

            $gestion = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->select("GESTION.ANO_GESTION")
                ->get()
                ->unique();

            $semestre = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->join("PERIODO", "PERIODO.ID", "=", "GESTION.PERIODO_ID")
                ->select("PERIODO.DESCRIPCION")
                ->get()
                ->unique();

            $materia = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->join("MATERIA", "MATERIA.GESTION_ID", "=", "GESTION.ID")
                ->select("MATERIA.NOMBRE_MATERIA")
                ->get()
                ->unique();
                
            return view('estudiante/ver/portafolio')
                ->with('archivo', $archivo)
                ->with('fecha', $fecha)
                ->with('lugar', $lugar)
                ->with('gestion', $gestion)
                ->with('semestre', $semestre)
                ->with('materia', $materia);
        }
        return redirect('login');
    }
    
    /*public function getVerPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $clase_id = $request->materia;

            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;

            $archivo = SesionEstudiante::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", " SESION_ESTUDIANTE.ID")
                ->join("SESION", "SESION.ID", "=", " SESION_ESTUDIANTE.SESION_ID")
                ->join("CLASE", "CLASE.ID", "=", "SESION.CLASE_ID")
                ->where("CLASE_ID", $clase_id)
                ->select("ENVIO_PRACTICA.ARCHIVO")
                ->get();

             $fecha = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION", "SESION.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION_ESTUDIANTE", "SESION_ESTUDIANTE.SESION_ID", "=", "SESION.ID")
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", "ENVIO_PRACTICA.ID")
                ->select("ENVIO_PRACTICA.LUGAR")
                ->get()
                ->unique();

            $lugar = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION", "SESION.CLASE_ID", "=", "CLASE.ID")
                ->join("SESION_ESTUDIANTE", "SESION_ESTUDIANTE.SESION_ID", "=", "SESION.ID")
                ->join("ENVIO_PRACTICA", "ENVIO_PRACTICA.SESION_ESTUDIANTE_ID", "=", "ENVIO_PRACTICA.ID")
                ->select("ENVIO_PRACTICA.LUGAR")
                ->get()
                ->unique();

            $gestion = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->select("GESTION.ANO_GESTION")
                ->get()
                ->unique();

            $semestre = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->join("PERIODO", "PERIODO.ID", "=", "GESTION.PERIODO_ID")
                ->select("PERIODO.DESCRIPCION")
                ->get()
                ->unique();

            $materia = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->join("MATERIA", "MATERIA.GESTION_ID", "=", "GESTION.ID")
                ->select("MATERIA.NOMBRE_MATERIA")
                ->get()
                ->unique();
                
            return view('estudiante/ver/portafolio')
                ->with('archivo', $archivo)
                ->with('materia', $materia)
                ->with('semestre', $semestre)
                ->with('gestion', $gestion)
                ->with('fecha', $fecha);
        }
        return redirect('login');
    }*/
}


           