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

            $periodos = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->join("PERIODO", "PERIODO.ID", "=", "GESTION.PERIODO_ID")
                ->select("PERIODO.DESCRIPCION")
                ->get()
                ->unique();

            $materias = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                ->join("MATERIA", "MATERIA.GESTION_ID", "=", "GESTION.ID")
                ->select("MATERIA.NOMBRE_MATERIA")
                ->get()
                ->unique();

            return view('estudiante/formularioPortafolio')
                ->with('gestiones', $gestiones)
                ->with('periodos', $periodos)
                ->with('materias', $materias);
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
            $archivo = 
            $fecha = 
            $lugar = 
            return view('estudiante/ver/portafolio');
        }
        return redirect('login');
    }
}
