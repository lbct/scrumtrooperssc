<?php

namespace App\Http\Controllers\Docente\Portafolio\Ver;

use App\Models\Usuario;
use App\Models\EstudianteClase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Docente\Base;
use App\Models\Estudiante;
use App\Models\Periodo;
use App\Models\SesionEstudiante;
use App\Models\Clase;
use App\Models\Sesion;
use App\Models\Gestion;
use App\Models\GrupoADocente;
use App\Models\GrupoDocente;

class Control extends Base
{
    private function getUltimaGestion()
    {
        $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
        return $id_gestion;
    }
    
    //obtiene la vista del formulario para ver el portafolio del estudiante con sesion iniciada
    public function getPortafolios(Request $request)
    {
        if ($this->rol->is($request)) {
            $docente    = Usuario::find($request->cookie('USUARIO_ID'))->docente;

            $gestiones = GrupoADocente::where("GRUPO_A_DOCENTE.DOCENTE_ID", $docente->ID)
                         ->join("GRUPO_DOCENTE", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID", "=", "GRUPO_DOCENTE.ID")
                         ->join("MATERIA", "GRUPO_DOCENTE.MATERIA_ID", "=", "MATERIA.ID")
                         ->join("GESTION", "MATERIA.GESTION_ID", "=", "GESTION.ID")
                         ->join("PERIODO", "GESTION.PERIODO_ID", "=", "PERIODO.ID")
                         ->select("GESTION.ID", "GESTION.ANO_GESTION", "PERIODO.DESCRIPCION")
                         ->orderBy("GESTION.ID", "desc")
                         ->get()
                         ->unique("GESTION.ID");
            
            $gestion_actual = $this->getUltimaGestion();
            
            $materias  = GrupoADocente::where("GRUPO_A_DOCENTE.DOCENTE_ID", $docente->ID)
                         ->join("GRUPO_DOCENTE", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID", "=", "GRUPO_DOCENTE.ID")
                         ->join("MATERIA", "GRUPO_DOCENTE.MATERIA_ID", "=", "MATERIA.ID")
                         ->where("MATERIA.GESTION_ID", $gestion_actual)
                         ->select("GRUPO_DOCENTE.ID AS GRUPO_DOCENTE_ID", "MATERIA.CODIGO_MATERIA", "MATERIA.NOMBRE_MATERIA", "GRUPO_DOCENTE.DETALLE_GRUPO_DOCENTE")
                         ->get();
            
            return view('docente.ver.portafolio.materias')
                   ->with('gestiones', $gestiones)
                   ->with('materias', $materias);
        }

        return redirect('login');
    }

    public function verMaterias(Request $request)
    {
        if ($this->rol->is($request)) {
            $docente = Usuario::find($request->cookie('USUARIO_ID'))->docente;

            $gestion_id = $request->gestion;

            $materias  = GrupoADocente::where("GRUPO_A_DOCENTE.DOCENTE_ID", $docente->ID)
                         ->join("GRUPO_DOCENTE", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID", "=", "GRUPO_DOCENTE.ID")
                         ->join("MATERIA", "GRUPO_DOCENTE.MATERIA_ID", "=", "MATERIA.ID")
                         ->where("MATERIA.GESTION_ID", $gestion_id)
                         ->select("GRUPO_DOCENTE.ID AS GRUPO_DOCENTE_ID", "MATERIA.CODIGO_MATERIA", "MATERIA.NOMBRE_MATERIA", "GRUPO_DOCENTE.DETALLE_GRUPO_DOCENTE")
                         ->get();

            return $materias;
        }

        return redirect('login');
    }
    
    public function verEstudiantes(Request $request)
    {
        if ($this->rol->is($request)) {
            $docente = Usuario::find($request->cookie('USUARIO_ID'))->docente;

            $grupo_docente_id = $request->grupo_docente_id;

            $estudiantes = GrupoADocente::where("GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID",$grupo_docente_id)
                           ->join("CLASE", "CLASE.GRUPO_A_DOCENTE_ID", "=", "GRUPO_A_DOCENTE.ID")
                           ->join("ESTUDIANTE_CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                           ->join("ESTUDIANTE", "ESTUDIANTE.ID", "=", "ESTUDIANTE_CLASE.ESTUDIANTE_ID")
                           ->join("USUARIO", "USUARIO.ID", "=", "ESTUDIANTE.USUARIO_ID")
                           ->select("CODIGO_SIS", "USERNAME", "NOMBRE", "APELLIDO", "CLASE_ID", "ESTUDIANTE.ID AS ESTUDIANTE_ID")
                           ->get();
            
            $materia = GrupoDocente::find($grupo_docente_id)->materia;
            
            return view('docente.ver.portafolio.estudiantes')
                   ->with('estudiantes', $estudiantes)
                   ->with('materia', $materia);
        }

        return redirect('login');
    }

    public function verPortafolio(Request $request)
    {
        if ($this->rol->is($request)) {
            $clase_id = $request->clase_id;
            $estudiante_id = $request->estudiante_id;
            
            $estudiante = Estudiante::where("ESTUDIANTE.ID", $estudiante_id)
                          ->join("USUARIO", "USUARIO.ID", "=", "ESTUDIANTE.USUARIO_ID")
                          ->select("NOMBRE", "APELLIDO", "CODIGO_SIS", "ESTUDIANTE.ID")
                          ->first();

            $practicas = SesionEstudiante::where("ESTUDIANTE_ID", $estudiante_id)
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
            
            $sesiones = SesionEstudiante::where("SESION_ESTUDIANTE.ESTUDIANTE_ID", $estudiante_id)
                        ->join("SESION", "SESION.ID", "=", "SESION_ESTUDIANTE.SESION_ID")
                        ->where("SESION.CLASE_ID",$clase_id)
                        ->where("SESION.SEMANA","<=",$materia->SEMANA_ACTUAL_SESION)
                        ->select("SESION.ID", "SEMANA", "COMENTARIO_AUXILIAR", "ASISTENCIA_SESION")
                        ->orderBy("SEMANA")
                        ->get();
            
            return view('docente.ver.portafolio.semanas')
                ->with('practicas', $practicas)
                ->with('sesiones', $sesiones)
                ->with('materia', $materia)
                ->with('estudiante', $estudiante);
        }
        return redirect('login');
    }
}


           