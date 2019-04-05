<?php
namespace App\Http\Controllers\Estudiante;

use App\Models\Usuario;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Docente;
use App\Models\GrupoDocente;
use App\Models\EstudianteClase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Inscripcion extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $materias = Materia::select('MATERIA.ID', 'NOMBRE_MATERIA')->get();
            return view('estudiante.inscripcion')->with('materias', $materias);
        }
            
        return redirect('login');
    }

    public function postInscripcion(Request $request)
    {
        $paso = $request->paso;
        if( $this->rol->is($request) )
        {
            if($paso == 1)
            {
                $materias = Materia::select('MATERIA.ID', 'NOMBRE_MATERIA')->get();

                return $materias;
            }
            else if($paso == 2)
            {
                $materia = $request->materia;
                $gruposdocentes =   Materia::where('MATERIA.ID', $materia)
                                    ->join('GRUPO_DOCENTE', 'MATERIA.ID', '=', 'GRUPO_DOCENTE.MATERIA_ID')
                                    ->join('GRUPO_A_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID')
                                    ->join('DOCENTE', 'GRUPO_A_DOCENTE.DOCENTE_ID', '=', 'DOCENTE.ID')
                                    ->join('USUARIO', 'DOCENTE.USUARIO_ID', '=', 'USUARIO.ID')
                                    ->select('GRUPO_DOCENTE.ID', 'NOMBRE', 'APELLIDO')
                                    ->get();

                return $gruposdocentes;
            }
            else if($paso == 3)
            {
                $grupoDocente = $request->docente;
                $clases =   GrupoDocente::where('GRUPO_DOCENTE.ID', $grupoDocente)
                            ->join('GRUPO_A_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID')
                            ->join('CLASE', 'GRUPO_A_DOCENTE.ID', '=', 'CLASE.GRUPO_A_DOCENTE_ID')
                            ->join('HORARIO', 'CLASE.HORARIO_ID', '=', 'HORARIO.ID')
                            ->join('AULA', 'CLASE.AULA_ID', '=', 'AULA.ID')
                            ->select('CLASE.ID', 'NOMBRE_AULA', 'HORA_INICIO', 'HORA_FIN', 'DIA')
                            ->get();

                return $clases;
            }
            else if($paso == 4)
            {
                $clase = intval($request->horario);
                $usuario = Usuario::find($request->cookie('USUARIO_ID'));
                $estudiante = $usuario->estudiante;

                $estudianteClase = new EstudianteClase();

                $estudianteClase->CLASE_ID      = $clase;
                $estudianteClase->ESTUDIANTE_ID = $estudiante->ID;

                $estudianteClase->save();

                return $estudianteClase;
            }
        }
    }

}