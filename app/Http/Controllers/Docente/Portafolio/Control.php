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
    public function descargar(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoGrupoDocente($grupo_docente_id)){
            $grupo_a_docente = GrupoADocente::where('grupo_docente_id', $grupo_docente_id)
                               ->where('docente_id', $docente->id)
                               ->first();
            
            $existe_archivo = Storage::disk('temporalPortafolio')->exists($grupo_a_docente->id.'.zip');
            if($existe_archivo)
                Storage::disk('temporalPortafolio')->delete($grupo_a_docente->id.'.zip');
            
            $estudiantes_inscritos = EstudianteClase::where('grupo_a_docente_id', $grupo_a_docente->id)
                                     ->join('estudiante', 'estudiante.id', '=', 'estudiante_clase.estudiante_id')
                                     ->join('usuario', 'usuario.id', '=', 'estudiante.usuario_id')
                                     ->join('sesion_estudiante', 'sesion_estudiante.estudiante_clase_id', '=', 'estudiante_clase.id')
                                     ->join('sesion', 'sesion_estudiante.sesion_id', '=', 'sesion.id')
                                     ->orderBy('estudiante.id')
                                     ->orderBy('sesion.semana')
                                     ->select('sesion_estudiante.id as sesion_estudiante_id', 'codigo_sis', 'nombre', 'apellido', 'asistencia_sesion', 'sesion.semana', 'estudiante.id')
                                     ->get();
            
            $estudiantes = [];
            foreach($estudiantes_inscritos as $estudiante_inscrito){
                $index = $estudiante_inscrito->codigo_sis;
                
                if( array_key_exists($index, $estudiantes) ){
                    $datos['asistencia'] = $estudiante_inscrito->asistencia;
                    $datos['sesion_estudiante_id'] = $estudiante_inscrito->sesion_estudiante_id;
                    $estudiantes[$index]['semanas'][$estudiante_inscrito->semana] = $datos;
                }else{
                    $estudiantes[$index] = collect();
                    $estudiantes[$index]['nombre'] = $estudiante_inscrito->nombre.' '.$estudiante_inscrito->apellido;
                    
                    $datos['asistencia'] = $estudiante_inscrito->asistencia;
                    $datos['sesion_estudiante_id'] = $estudiante_inscrito->sesion_estudiante_id;
                    
                    $estudiantes[$index]['semanas'] = collect();
                    $estudiantes[$index]['semanas'][$estudiante_inscrito->semana] = $datos;
                }
            }
            
            $zipper = new Zipper;
            
            $archivos_enviados = collect();
            foreach($estudiantes as $codigo_sis => $estudiante){
                foreach($estudiante['semanas'] as $num_semana => $semana){
                    $practicas = EnvioPractica::where('sesion_estudiante_id', $semana['sesion_estudiante_id'])
                                 ->get();
                    
                    foreach($practicas as $practica){
                        $ruta = storage_path('app/practicasEstudiantes').'/'
                                             .$semana['sesion_estudiante_id'].'/'
                                             .$practica['archivo'];
                        
                        $asistencia = 'Asistencia';
                        
                        if(!$semana['asistencia'])
                            $asistencia = 'Sin Asistencia';
                        
                        $directorio = $codigo_sis.' - '.$estudiante['nombre'].'/'.$num_semana.' - '.$asistencia;
                        
                        $zipper->make(storage_path('app/portafolios').'/'.$grupo_a_docente->id.'.zip')
                               ->folder($directorio)
                               ->add($ruta);
                    }
                }
            }
            
            $zipper->close();
            
            $existe_archivo = Storage::disk('temporalPortafolio')->exists($grupo_a_docente->id.'.zip');
            
            if($existe_archivo)
                return response()->download(storage_path('app/portafolios/'.$grupo_a_docente->id.'.zip'));
            else
                return "No hay envíos de prácticas para este grupo";
        }
    }
}