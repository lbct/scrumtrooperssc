<?php
namespace App\Http\Controllers\Docente\Estadistica;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\GuiaPractica;
use App\Classes\Gestiones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function gruposdocentes(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $docente->materias($gestion_actual->id);
        
        return $grupos_docentes->count();
    }
    
    public function guiaspracticas(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $docente->materias($gestion_actual->id);
        $total = 0;
        
        foreach($grupos_docentes as $grupo_docente){
            $clase = Clase::where('grupo_docente_id', $grupo_docente->id)
                     ->first();
            
            $semanas = Sesion::where('clase_id', $clase->id)
                       ->orderBy('semana', 'desc')
                       ->first();
            
            $total+=$semanas->semana;
        }
        
        return $total;
    }
    
    public function estudiantesinscritos(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $docente->materias($gestion_actual->id);
        $total = 0;
        
        foreach($grupos_docentes as $grupo_docente){
            $cantidad_estudiantes = GrupoADocente::where('docente_id', $docente->id)
                                    ->where('grupo_docente_id', $grupo_docente->id)
                                    ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                    ->count();
            
            $total+=$cantidad_estudiantes;
        }
        
        return $total;
    }
    
    public function enviostotales(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $docente->materias($gestion_actual->id);
        $total = 0;
        
        foreach($grupos_docentes as $grupo_docente){
            $cantidad_envios = GrupoADocente::where('docente_id', $docente->id)
                               ->where('grupo_docente_id', $grupo_docente->id)
                               ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                               ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                               ->join('envio_practica', 'envio_practica.sesion_estudiante_id', '=', 'sesion_estudiante.id')
                               ->count();
            
            $total+=$cantidad_envios;
        }
        
        return $total;
    }
    
    public function enviospracticas(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $docente->materias($gestion_actual->id);
        $estadisticas = collect();
        
        foreach($grupos_docentes as $grupo_docente){
            $semana_maxima = GrupoDocente::find($grupo_docente->id)->maximaSemana();
            
            $fuera  = collect();
            $en_lab = collect();
            
            for($semana=1; $semana<=$semana_maxima; $semana++){
                $cantidad_fuera = GrupoADocente::where('docente_id', $docente->id)
                                  ->where('grupo_docente_id', $grupo_docente->id)
                                  ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                  ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                  ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                  ->where('sesion.semana', $semana)
                                  ->join('envio_practica', 'envio_practica.sesion_estudiante_id', '=', 'sesion_estudiante.id')
                                  ->where('envio_practica.en_laboratorio', false)
                                  ->count();
                $fuera->push($cantidad_fuera);
                
                $cantidad_en_lab = GrupoADocente::where('docente_id', $docente->id)
                                   ->where('grupo_docente_id', $grupo_docente->id)
                                   ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                   ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                   ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                   ->where('sesion.semana', $semana)
                                   ->join('envio_practica', 'envio_practica.sesion_estudiante_id', '=', 'sesion_estudiante.id')
                                   ->where('envio_practica.en_laboratorio', true)
                                   ->count();
                $en_lab->push($cantidad_en_lab);
            }
                
            $grupo_docente['fuera_laboratorio'] = $fuera;
            $grupo_docente['en_laboratorio']    = $en_lab;
            $grupo_docente['semanas']           = $semana_maxima;
            $estadisticas->push($grupo_docente);
        }
        
        return $estadisticas;
    }
    
    public function asistencia(Request $request){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $gestion_actual = Gestiones::gestionActiva();
        
        $grupos_docentes = $docente->materias($gestion_actual->id);
        $estadisticas = collect();
        
        foreach($grupos_docentes as $grupo_docente){
            $semana_maxima = GrupoDocente::find($grupo_docente->id)->maximaSemana();
            
            $no_asistencia  = collect();
            $asistencia     = collect();
            
            for($semana=1; $semana<=$semana_maxima; $semana++){
                $cantidad_no_asistencia = GrupoADocente::where('docente_id', $docente->id)
                                          ->where('grupo_docente_id', $grupo_docente->id)
                                          ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                          ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                          ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                          ->where('sesion.semana', $semana)
                                          ->where('sesion_estudiante.asistencia_sesion', false)
                                          ->count();
                $no_asistencia->push($cantidad_no_asistencia);
                
                $cantidad_asistencia = GrupoADocente::where('docente_id', $docente->id)
                                       ->where('grupo_docente_id', $grupo_docente->id)
                                       ->join('estudiante_clase', 'estudiante_clase.grupo_a_docente_id', '=', 'grupo_a_docente.id')
                                       ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                       ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                                       ->where('sesion.semana', $semana)
                                       ->where('sesion_estudiante.asistencia_sesion', true)
                                       ->count();
                $asistencia->push($cantidad_asistencia);
            }
                
            $grupo_docente['no_asistencia'] = $no_asistencia;
            $grupo_docente['asistencia']    = $asistencia;
            $grupo_docente['semanas']       = $semana_maxima;
            $estadisticas->push($grupo_docente);
        }
        
        return $estadisticas;
    }
}