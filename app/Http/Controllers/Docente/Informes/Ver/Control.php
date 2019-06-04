<?php
namespace App\Http\Controllers\Docente\Informes\Ver;

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
    //Obtiene la vista principal del Docente
    public function getInformes(Request $request)
    {
        if( $this->rol->is($request)){
            return view('docente.informes.ver');
        }
        return redirect('login');
    }

    public function getClasesUltimaGestion(Request $request)
    {
        if( $this->rol->is($request)){
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            return $this->getClases($request, $id_gestion);
        }
        return redirect('login');
    }

    public function getClases(Request $request, $id_gestion){
        if( $this->rol->is($request) ){
            $usuarioId = $request->cookie('USUARIO_ID');
            $docenteId = Docente::where('USUARIO_ID', '=', $usuarioId)->get()->first()->ID;
            $gestiones = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->get();

            $gruposDocente = GrupoDocente::join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
            ->join('MATERIA', 'MATERIA.ID', '=', 'GRUPO_DOCENTE.MATERIA_ID')
            ->where('GRUPO_A_DOCENTE.DOCENTE_ID', '=', $docenteId)
            ->where('MATERIA.GESTION_ID', '=', $id_gestion)
            ->select('GRUPO_DOCENTE.ID' ,'GRUPO_DOCENTE.MATERIA_ID', 'GRUPO_DOCENTE.DETALLE_GRUPO_DOCENTE', 'MATERIA.NOMBRE_MATERIA', 'MATERIA.CODIGO_MATERIA')
            ->get();
            
            $asistencias = [];
            $inscritos = [];
            foreach($gruposDocente as $grupoDocente){

                $clasesId = GrupoDocente::where('GRUPO_DOCENTE.ID', '=', $grupoDocente->ID)
                ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
                ->join('CLASE', 'CLASE.GRUPO_A_DOCENTE_ID', '=', 'GRUPO_A_DOCENTE.ID')
                ->groupBy('CLASE.ID')
                ->select('CLASE.ID as ID')
                ->get();

                $total = 0;
                $suma = 0;
                foreach ($clasesId as $claseId){
                    $sesiones = Sesion::where('CLASE_ID', '=', $claseId->ID)->get();
                    if($sesiones != null && sizeof($sesiones)>0){
                        $estudiantes = EstudianteClase::where('CLASE_ID', '=', $claseId->ID)->get();
                        foreach($sesiones as $sesion){
                            if($sesion->AUXILIAR_ID != null){
                                foreach($estudiantes as $estudiante){
                                    $sesion_est = SesionEstudiante::where('SESION_ID', '=', $sesion->ID)
                                    ->where('ESTUDIANTE_ID', '=', $estudiante->ESTUDIANTE_ID)
                                    ->get()
                                    ->first();
                                    if($sesion_est != null && $sesion_est->ASISTENCIA_SESION == 1){
                                        $suma = $suma + 1;
                                    }
                                    $total++;
                                }
                            }
                        }
                    }
                }
                $asistencias[$grupoDocente->MATERIA_ID] = round((($suma/($total == 0 ? 1 : $total))*100), 2).'%';
                $inscritos[$grupoDocente->MATERIA_ID] = $total;
                //array_push($asistencias, [$grupoDocente->MATERIA_ID => (($suma/$total)*100)]);
            }
            return view('docente.informes.materias.ver')
                ->with('id_gestion', $id_gestion)
                ->with('gestiones', $gestiones)
                ->with('materias', $gruposDocente)
                ->with('asistencias', $asistencias)
                ->with('inscritos', $inscritos);
        }
        return redirect('login');
    }

    public function getListas(Request $request){
        $gestionID = $request->gestion_id;
        $grupoDocente = GrupoDocente::find($request->grupo_docente_id);

        $clasesId = GrupoDocente::where('GRUPO_DOCENTE.ID', '=', $grupoDocente->ID)
        ->join('GRUPO_A_DOCENTE', 'GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID', '=', 'GRUPO_DOCENTE.ID')
        ->join('CLASE', 'CLASE.GRUPO_A_DOCENTE_ID', '=', 'GRUPO_A_DOCENTE.ID')
        ->groupBy('CLASE.ID')
        ->select('CLASE.ID as ID')
        ->get();

        $asistencias = [];
        foreach ($clasesId as $claseId) {
            $clase = Clase::find($claseId->ID);
            $sesiones = Sesion::where('CLASE_ID', '=', $clase->ID)->get();
            if($sesiones != null && sizeof($sesiones)>0){
                $estudiantes = EstudianteClase::where('CLASE_ID', '=', $clase->ID)->get();
                foreach($sesiones as $sesion){
                    $total = 0;
                    $suma = 0;
                    foreach($estudiantes as $estudiante){
                        $sesion_est = SesionEstudiante::where('SESION_ID', '=', $sesion->ID)
                        ->where('ESTUDIANTE_ID', '=', $estudiante->ESTUDIANTE_ID)
                        ->get()
                        ->first();
                        if($sesion_est != null && $sesion_est->ASISTENCIA_SESION == 1){
                            $suma = $suma + 1;
                        }
                        $total++;
                    }
                    if($sesion->AUXILIAR_ID != null){
                        $auxiliar = Auxiliar::where('ID', '=', $sesion->AUXILIAR_ID)->get()->first()->Usuario;
                        $dia_clase;
                        switch($clase->DIA){
                            case 1 : $dia_clase = 'Lunes'; break;
                            case 2 : $dia_clase = 'Martes'; break;
                            case 3 : $dia_clase = 'Miércoles'; break;
                            case 4 : $dia_clase = 'Jueves'; break;
                            case 5 : $dia_clase = 'Viernes'; break;
                            case 6 : $dia_clase = 'Sábado'; break;
                            case 7 : $dia_clase = 'Domingo'; break;
                        }
                        array_push($asistencias,
                        [
                            'Dia' => $dia_clase,
                            'Hora' => $clase->Horario->HORA_INICIO,
                            'IdSesion' => $sesion->ID,
                            'NSemana' => $sesion->SEMANA,
                            'Auxiliar' => $auxiliar->NOMBRE.' '.$auxiliar->APELLIDO,
                            'NEstudiantes' => $total,
                            'Porcentaje' => round((($suma/($total == 0 ? 1 : $total))*100), 2).'%',
                        ]);
                    }
                }
            }
        }
        return view('docente.informes.estudiantes.ver')
        ->with('asistencias', $asistencias);
    }
}