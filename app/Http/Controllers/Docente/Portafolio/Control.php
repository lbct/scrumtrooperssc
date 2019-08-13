<?php
namespace App\Http\Controllers\Docente\Portafolio;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Models\EstudianteClase;
use App\Models\EnvioPractica;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Input;
use Chumper\Zipper\Zipper;

class Control extends Base
{
    private function retirarPunto($texto){
        $salida = "";
        
        for ($i = 0; $i < strlen($texto); $i++){
            if($texto[$i] != '.')
                $salida=$salida.$texto[$i];
        }
        
        return $salida;
    }
    
    public function descargar(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoGrupoDocente($grupo_docente_id)){
            $grupo_a_docente = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                               ->where('docente_id', $docente->id)
                               ->first();
            
            $existe_directorio = Storage::disk('portafolios')->exists($grupo_a_docente->id);
            if($existe_directorio)
                Storage::disk('portafolios')->deleteDirectory($grupo_a_docente->id, true);
            
            $estudiantes_inscritos = EstudianteClase::where('grupo_a_docente_id', $grupo_a_docente->id)
                                     ->join('estudiante', 'estudiante.id', '=', 'estudiante_clase.estudiante_id')
                                     ->join('usuario', 'usuario.id', '=', 'estudiante.usuario_id')
                                     ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                     ->join('sesion', 'sesion_estudiante.sesion_id', '=', 'sesion.id')
                                     ->orderBy('estudiante.id')
                                     ->orderBy('sesion.semana')
                                     ->select('sesion_estudiante.id as sesion_estudiante_id', 'codigo_sis', 'nombre', 'apellido', 'asistencia_sesion', 'sesion.semana', 'estudiante.id', 'comentario_auxiliar')
                                     ->get();
            
            $estudiantes = [];
            foreach($estudiantes_inscritos as $estudiante_inscrito){
                $index = $estudiante_inscrito->codigo_sis;
                
                if( array_key_exists($index, $estudiantes) ){
                    $datos['asistencia'] = $estudiante_inscrito->asistencia_sesion;
                    $datos['sesion_estudiante_id'] = $estudiante_inscrito->sesion_estudiante_id;
                    if($estudiante_inscrito->comentario_auxiliar)
                        $datos['comentario_auxiliar'] = $this->retirarPunto($estudiante_inscrito->comentario_auxiliar);
                    else
                        $datos['comentario_auxiliar'] = 'Sin comentario';
                    $estudiantes[$index]['semanas'][$estudiante_inscrito->semana] = $datos;
                }else{
                    $estudiantes[$index] = collect();
                    $estudiantes[$index]['nombre'] = $this->retirarPunto($estudiante_inscrito->nombre.' '.$estudiante_inscrito->apellido);
                    
                    $datos['asistencia'] = $estudiante_inscrito->asistencia_sesion;
                    $datos['sesion_estudiante_id'] = $estudiante_inscrito->sesion_estudiante_id;
                    
                    if($estudiante_inscrito->comentario_auxiliar)
                        $datos['comentario_auxiliar'] = $this->retirarPunto($estudiante_inscrito->comentario_auxiliar);
                    else
                        $datos['comentario_auxiliar'] = 'Sin comentario';
                    
                    $estudiantes[$index]['semanas'] = collect();
                    $estudiantes[$index]['semanas'][$estudiante_inscrito->semana] = $datos;
                }
            }
            
            foreach($estudiantes as $codigo_sis => $estudiante){
                foreach($estudiante['semanas'] as $num_semana => $semana){
                    $practicas = EnvioPractica::where('sesion_estudiante_id', $semana['sesion_estudiante_id'])
                                 ->get();
                    
                    foreach($practicas as $practica){
                        $asistencia = 'Sin Asistencia';
                        if($semana['asistencia'])
                            $asistencia = 'Asistencia';
                        
                        $en_lab = 'Fuera Laboratorio';
                        if($practica['en_laboratorio'])
                            $en_lab = 'En Laboratorio';
                        
                        $origen = '/practicasEstudiantes/'.
                                  $semana['sesion_estudiante_id'].'/'.
                                  $practica['archivo'];
                        
                        $destino = 'portafolios/'.
                                   $grupo_a_docente->id.'/'.
                                   $codigo_sis.' - '.
                                   $estudiante['nombre'].'/'.
                                   $num_semana.' - '.
                                   $asistencia.' - '.
                                   $semana['comentario_auxiliar'].'/'.
                                   $en_lab.'/'.
                                   $practica['archivo'];
                        
                        Storage::copy($origen, $destino);
                    }
                }
            }

            $existe_archivo = Storage::disk('portafolios')->exists($grupo_a_docente->id);
            if($existe_archivo){
                $existe_comprimido = Storage::disk('portafolios')->exists($grupo_a_docente->id.'.zip');
                if($existe_comprimido)
                    Storage::disk('portafolios')->delete($grupo_a_docente->id.'.zip');
                
                $zipper = new Zipper;
                $zipper->make(storage_path('app/portafolios').'/'.$grupo_a_docente->id.'.zip')
                         ->add(storage_path('app/portafolios').'/'.$grupo_a_docente->id);
                $zipper->close();
                
                Storage::disk('portafolios')->deleteDirectory($grupo_a_docente->id, true);
                
                return response()->download(storage_path('app/portafolios/'.$grupo_a_docente->id.'.zip'));
            } 
            else
                return "No hay envíos de prácticas para este grupo.";
        }
    }
    
    public function descargarestudiante(Request $request, $estudiante_clase_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoEstudianteClase($estudiante_clase_id)){            
            $existe_directorio = Storage::disk('portafoliosEstudiantes')->exists($estudiante_clase_id);
            if($existe_directorio)
                Storage::disk('portafoliosEstudiantes')->deleteDirectory($estudiante_clase_id, true);
            
            $estudiantes_inscritos = EstudianteClase::where('estudiante_clase.id', $estudiante_clase_id)
                                     ->join('estudiante', 'estudiante.id', '=', 'estudiante_clase.estudiante_id')
                                     ->join('usuario', 'usuario.id', '=', 'estudiante.usuario_id')
                                     ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                     ->join('sesion', 'sesion_estudiante.sesion_id', '=', 'sesion.id')
                                     ->orderBy('estudiante.id')
                                     ->orderBy('sesion.semana')
                                     ->select('sesion_estudiante.id as sesion_estudiante_id', 'codigo_sis', 'nombre', 'apellido', 'asistencia_sesion', 'sesion.semana', 'estudiante.id', 'comentario_auxiliar')
                                     ->get();
            
            $estudiantes = [];
            foreach($estudiantes_inscritos as $estudiante_inscrito){
                $index = $estudiante_inscrito->codigo_sis;
                
                if( array_key_exists($index, $estudiantes) ){
                    $datos['asistencia'] = $estudiante_inscrito->asistencia_sesion;
                    $datos['sesion_estudiante_id'] = $estudiante_inscrito->sesion_estudiante_id;
                    if($estudiante_inscrito->comentario_auxiliar)
                        $datos['comentario_auxiliar'] = $this->retirarPunto($estudiante_inscrito->comentario_auxiliar);
                    else
                        $datos['comentario_auxiliar'] = 'Sin comentario';
                    $estudiantes[$index]['semanas'][$estudiante_inscrito->semana] = $datos;
                }else{
                    $estudiantes[$index] = collect();
                    $estudiantes[$index]['nombre'] = $this->retirarPunto($estudiante_inscrito->nombre.' '.$estudiante_inscrito->apellido);
                    
                    $datos['asistencia'] = $estudiante_inscrito->asistencia_sesion;
                    $datos['sesion_estudiante_id'] = $estudiante_inscrito->sesion_estudiante_id;
                    
                    if($estudiante_inscrito->comentario_auxiliar)
                        $datos['comentario_auxiliar'] = $this->retirarPunto($estudiante_inscrito->comentario_auxiliar);
                    else
                        $datos['comentario_auxiliar'] = 'Sin comentario';
                    
                    $estudiantes[$index]['semanas'] = collect();
                    $estudiantes[$index]['semanas'][$estudiante_inscrito->semana] = $datos;
                }
            }
            
            foreach($estudiantes as $codigo_sis => $estudiante){
                foreach($estudiante['semanas'] as $num_semana => $semana){
                    $practicas = EnvioPractica::where('sesion_estudiante_id', $semana['sesion_estudiante_id'])
                                 ->get();
                    
                    foreach($practicas as $practica){
                        $asistencia = 'Sin Asistencia';
                        if($semana['asistencia'])
                            $asistencia = 'Asistencia';
                        
                        $en_lab = 'Fuera Laboratorio';
                        if($practica['en_laboratorio'])
                            $en_lab = 'En Laboratorio';
                        
                        $origen = '/practicasEstudiantes/'.
                                  $semana['sesion_estudiante_id'].'/'.
                                  $practica['archivo'];
                        
                        $destino = 'portafoliosEstudiantes/'.
                                   $estudiante_clase_id.'/'.
                                   $codigo_sis.' - '.
                                   $estudiante['nombre'].'/'.
                                   $num_semana.' - '.
                                   $asistencia.' - '.
                                   $semana['comentario_auxiliar'].'/'.
                                   $en_lab.'/'.
                                   $practica['archivo'];
                        
                        Storage::copy($origen, $destino);       
                    }
                }
            }

            $existe_archivo = Storage::disk('portafoliosEstudiantes')->exists($estudiante_clase_id);
            if($existe_archivo){
                $existe_comprimido = Storage::disk('portafoliosEstudiantes')->exists($estudiante_clase_id.'.zip');
                if($existe_comprimido)
                    Storage::disk('portafoliosEstudiantes')->delete($estudiante_clase_id.'.zip');
                
                $zipper = new Zipper;
                $zipper->make(storage_path('app/portafoliosEstudiantes').'/'.$estudiante_clase_id.'.zip')
                         ->add(storage_path('app/portafoliosEstudiantes').'/'.$estudiante_clase_id);
                $zipper->close();
                
                Storage::disk('portafoliosEstudiantes')->deleteDirectory($estudiante_clase_id, true);
                
                return response()->download(storage_path('app/portafoliosEstudiantes/'.$estudiante_clase_id.'.zip'));
            } 
            else
                return "No hay envíos de prácticas para este estudiante.";
        }
    }
}