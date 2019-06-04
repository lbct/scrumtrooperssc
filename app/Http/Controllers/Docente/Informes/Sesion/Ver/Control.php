<?php
namespace App\Http\Controllers\Docente\Informes\Sesion\Ver;

use App\Models\Usuario;
use App\Models\Sesion;
use App\Models\Materia;
use App\Models\EstudianteClase;
use App\Models\Estudiante;
use App\Models\SesionEstudiante;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\GuiaPractica;
use App\Models\Auxiliar;
use App\Models\Docente;
use App\Models\Gestion;
use App\Classes\Rol;
use App\Models\Clase;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Response;

class Control extends Base
{
    public function getSesion(Request $request){
        $estudiantes = Sesion::where('SESION.ID', '=', $request->sesion_id)
        ->join('CLASE', 'SESION.CLASE_ID', '=', 'CLASE.ID')
        ->join('ESTUDIANTE_CLASE', 'ESTUDIANTE_CLASE.CLASE_ID', '=', 'CLASE.ID')
        ->join('ESTUDIANTE', 'ESTUDIANTE.ID', '=', 'ESTUDIANTE_CLASE.ESTUDIANTE_ID')
        ->join('USUARIO', 'USUARIO.ID', '=', 'ESTUDIANTE.USUARIO_ID')
        ->select('ESTUDIANTE.ID', 'ESTUDIANTE.CODIGO_SIS', 'USUARIO.NOMBRE', 'USUARIO.APELLIDO')
        ->get();

        $asistencia = [];
        $comentario = [];
        foreach($estudiantes as $estudiante){
            $sesion_est = SesionEstudiante::where('SESION_ID', $request->sesion_id)
            ->where('ESTUDIANTE_ID', '=', $estudiante->ID)
            ->get()->first();
            if($sesion_est != null){
                $asistencia[$estudiante->ID] = $sesion_est->ASISTENCIA_SESION == 1 ? 'Asiste' : 'No Asiste';
                $comentario[$estudiante->ID] = $sesion_est->COMENTARIO_AUXILIAR;
            }
            else{
                $asistencia[$estudiante->ID] = 'No Asiste';
                $comentario[$estudiante->ID] = '';
            }
        }

        return view('docente.informes.estudiantes.lista')
        ->with('estudiantes', $estudiantes)
        ->with('asistencia', $asistencia)
        ->with('comentario', $comentario);
    }
}