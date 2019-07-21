<?php
namespace App\Http\Controllers\AuxiliarTerminal\Estadistica;

use App\Models\Usuario;
use App\Models\Auxiliar;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\GrupoDocenteAuxiliar;
use App\Classes\Gestiones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuxiliarTerminal\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function gruposdocentes(Request $request){
        $usuario_id = session('usuario_id'); 
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $auxiliar->materias($gestion_actual->id);
        
        return $grupos_docentes->count();
    }
    
    public function estudiantesinscritos(Request $request){
        $usuario_id = session('usuario_id'); 
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $total = GrupoDocenteAuxiliar::where('auxiliar_id', $auxiliar->id)
                 ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_docente_auxiliar.grupo_docente_id')
                 ->join('clase', 'clase.grupo_docente_id', '=', 'grupo_docente.id')
                 ->where('clase.gestion_id', $gestion_actual->id)
                 ->join('estudiante_clase', 'estudiante_clase.clase_id', '=', 'clase.id')
                 ->count();
        
        return $total;
    }
    
    public function cantidadclases(Request $request){
        $usuario_id = session('usuario_id'); 
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $total = GrupoDocenteAuxiliar::where('auxiliar_id', $auxiliar->id)
                 ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_docente_auxiliar.grupo_docente_id')
                 ->join('clase', 'clase.grupo_docente_id', '=', 'grupo_docente.id')
                 ->where('clase.gestion_id', $gestion_actual->id)
                 ->count();
        
        return $total;
    }
    
    public function clasescursadas(Request $request){
        $usuario_id = session('usuario_id'); 
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $total = GrupoDocenteAuxiliar::where('auxiliar_id', $auxiliar->id)
                 ->join('grupo_docente', 'grupo_docente.id', '=', 'grupo_docente_auxiliar.grupo_docente_id')
                 ->join('clase', 'clase.grupo_docente_id', '=', 'grupo_docente.id')
                 ->where('clase.gestion_id', $gestion_actual->id)
                 ->join('sesion', 'sesion.clase_id', '=', 'clase.id')
                 ->where('sesion.auxiliar_terminal_id', $auxiliar->id)
                 ->count();
        
        return $total;
    }
    
    public function enviospracticas(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id'); 
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $estadisticas = collect();
        
        if($auxiliar->esAuxiliarTerminal($grupo_docente_id)){
            $semana_maxima = GrupoDocente::find($grupo_docente_id)->maximaSemanaActual();
            $fuera  = collect();
            $en_lab = collect();
            
            for($semana=1; $semana<=$semana_maxima; $semana++){
                $cantidad_fuera = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                                  ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                  ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                  ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                  ->where('sesion.semana', $semana)
                                  ->join('envio_practica', 'envio_practica.sesion_estudiante_id', '=', 'sesion_estudiante.id')
                                  ->where('envio_practica.en_laboratorio', false)
                                  ->count();
                $fuera->push($cantidad_fuera);
                
                $cantidad_en_lab = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                                   ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                   ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                   ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                   ->where('sesion.semana', $semana)
                                   ->join('envio_practica', 'envio_practica.sesion_estudiante_id', '=', 'sesion_estudiante.id')
                                   ->where('envio_practica.en_laboratorio', true)
                                   ->count();
                $en_lab->push($cantidad_en_lab);
            }
            
            $estadisticas['fuera_laboratorio'] = $fuera;
            $estadisticas['en_laboratorio']    = $en_lab;
            $estadisticas['semanas']           = $semana_maxima;
        }
        
        return $estadisticas;
    }
    
    public function asistencia(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id'); 
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        $estadisticas = collect();
        
        if($auxiliar->esAuxiliarTerminal($grupo_docente_id)){
            $semana_maxima = GrupoDocente::find($grupo_docente_id)->maximaSemanaActual();
            $no_asistencia  = collect();
            $asistencia     = collect();

            for($semana=1; $semana<=$semana_maxima; $semana++){
                $cantidad_no_asistencia = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                                          ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                          ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                          ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                          ->where('sesion.semana', $semana)
                                          ->where('sesion_estudiante.asistencia_sesion', false)
                                          ->count();
                $no_asistencia->push($cantidad_no_asistencia);
                
                $cantidad_asistencia = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                                       ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                       ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                       ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                       ->where('sesion.semana', $semana)
                                       ->where('sesion_estudiante.asistencia_sesion', true)
                                       ->count();
                $asistencia->push($cantidad_asistencia);
            }
                
            $estadisticas['no_asistencia'] = $no_asistencia;
            $estadisticas['asistencia']    = $asistencia;
            $estadisticas['semanas']       = $semana_maxima;
        }
        
        return $estadisticas;
    }
}