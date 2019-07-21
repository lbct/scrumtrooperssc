<?php

namespace App\Http\Controllers\Estudiante\Estadistica;

use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\GrupoADocente;
use App\Models\EnvioPractica;
use App\Models\EstudianteClase;
use App\Models\Horario;
use App\Models\Periodo;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;
use App\Classes\Gestiones;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function getDatos(){

        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        $periodo = Periodo::where('id', '=', $gestion_actual->periodo_id)->first();

        $datos['fecha'] = date('d-m-y', time());
        $datos['anho'] =  $gestion_actual->anho_gestion;
        $datos['periodo'] = $periodo->descripcion;
        
        $datos['numero_materias'] = EstudianteClase::where('estudiante_id', '=', $estudiante->id)
                                        ->join('clase', 'clase.id', '=', 'clase_id')
                                        ->where('gestion_id', '=', $gestion_actual->id)
                                        ->count();

        $datos['portafolio'] =  EstudianteClase::where('estudiante_id', '=', $estudiante->id)
                                                ->join('sesion_estudiante', 'estudiante_clase_id', '=', 'estudiante_clase.id')
                                                ->join('envio_practica', 'sesion_estudiante_id', '=', 'sesion_estudiante.id')
                                                ->count();
        
        return $datos;
    }

    public function getTablaClases(){
        $datos = [];

        $date = date('D', time());
        switch($date){
            case "Mon": $date = 1; break;
            case "Tue": $date = 2; break;
            case "Wed": $date = 3; break;
            case "Thu": $date = 4; break;
            case "Fri": $date = 5; break;
            case "Sat": $date = 6; break;
            default; $date = 7; break;
        }
        
        $horas = Horario::get();
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();

        $clases = EstudianteClase::where('estudiante_id', '=', $estudiante->id)
                                    ->join('clase', 'clase.id', '=', 'clase_id')
                                    ->where('dia', '=', $date)
                                    ->where('clase.gestion_id', '=', $gestion_actual->id)
                                    ->join('aula', 'aula.id', '=', 'aula_id')
                                    ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_docente_id')
                                    ->join('materia', 'materia.id', '=', 'materia_id')
                                    ->select('horario_id', 'nombre_aula', 'nombre_materia')
                                    ->get();
        

        foreach ($horas as $hora){
            $temp = [];
            array_push($temp, $hora->hora_inicio);
            foreach ($clases as $clase){
                if ($hora->id == $clase->horario_id){
                    array_push($temp, $clase->nombre_materia, $clase->nombre_aula);
                }
                else{
                    array_push($temp, null, null);
                }
            }
            array_push($datos, $temp);
        }
        return $datos;
    }

    public function getAsistencia(){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();

        $sesiones = EstudianteClase::where('estudiante_id', '=', $estudiante->id)
                                    ->join('clase', 'clase.id', '=', 'clase_id')
                                    ->where('gestion_id', '=', $gestion_actual->id)
                                    ->join('sesion_estudiante', 'estudiante_clase.id', '=', 'estudiante_clase_id')
                                    ->select('asistencia_sesion')
                                    ->get();
        $total = sizeof($sesiones);
        $asistencia = 0;
        foreach($sesiones as $sesion){
            if ($sesion->asistencia_sesion == 1){
                $asistencia++;
            }
        }
        $datos['total'] = $total;
        $datos['asistencia'] = $asistencia;
        $datos['porcentaje'] = [];
        array_push($datos['porcentaje'], 100*$asistencia/$total);

        return $datos;
    }
}