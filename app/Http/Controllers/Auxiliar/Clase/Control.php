<?php
namespace App\Http\Controllers\Auxiliar\Clase;

use App\Models\Usuario;
use App\Models\Auxiliar;
use App\Models\Sesion;
use App\Models\Gestion;
use App\Models\GuiaPractica;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\GrupoADocente;
use App\Models\Clase;
use App\Models\EstudianteClase;
use App\Models\EnvioPractica;
use App\Models\Estudiante;
use App\Models\SesionEstudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auxiliar\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{    
    public function postIniciarClase(Request $request)
    {
        if($this->rol->is($request))
        {
            $sesion = Sesion::find($request->sesion_id);
            $clases = getListaClases($request->sesion_id);
            $existeSesion = false;
            foreach($clases as $clase){
                $sesion_temp = Sesion::where('CLASE_ID', '=', $clase->ID)
                                        ->where('SEMANA', '=', $sesion->SEMANA)
                                        ->first();
                $existeSesion = $existeSesion || null != (SesionEstudiante::where('SESION_ID', '=', $sesion_temp->ID)->first());
            }

            if (!$existeSesion){
                foreach($clases as $clase){
                    $sesion_temp = Sesion::where('CLASE_ID', '=', $clase->ID)
                                            ->where('SEMANA', '=', $sesion->SEMANA)
                                            ->first();

                    $estudiantes = EstudianteClase::where('CLASE_ID', '=', $clase->ID)->get();
                    foreach($estudiantes as $estudiante){
                        $sesionEstudiante = new SesionEstudiante();
                        $sesionEstudiante->ESTUDIANTE_ID = $estudiante->ESTUDIANTE_ID;
                        $sesionEstudiante->SESION_ID = $sesion_temp->ID;
                        $sesionEstudiante->ASISTENCIA_SESION = false;
                        $sesionEstudiante->COMENTARIO_AUXILIAR = "";
                        $sesionEstudiante->save();
                    }
                }
                $request->session()->flash('alert-success', 'Clase Iniciada Correctamente');
            }
            else {
                $request->session()->flash('alert-danger', 'La Clase ya fue Iniciada.');
            }
            return redirect('auxiliar/practicas')->withInput();
            
        }
        return redirect('login');
    }

}

function getListaClases($sesion_id){

    $grupo = Sesion::where('SESION.ID', '=', $sesion_id)
        ->join('CLASE', 'CLASE.ID', '=', 'SESION.CLASE_ID')
        ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.ID', '=', 'CLASE.GRUPO_A_DOCENTE_ID')
        ->select('GRUPO_DOCENTE_ID')
        ->first();

    $clases = GrupoADocente::where('GRUPO_DOCENTE_ID', '=', $grupo->GRUPO_DOCENTE_ID)
        ->join('CLASE', 'GRUPO_A_DOCENTE_ID', '=', 'GRUPO_A_DOCENTE.ID')
        ->get();

    return $clases;
}