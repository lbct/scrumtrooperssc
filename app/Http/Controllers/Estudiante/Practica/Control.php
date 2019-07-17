<?php

namespace App\Http\Controllers\Estudiante\Practica;

use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\GrupoADocente;
use App\Models\EnvioPractica;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function guias(Request $request, $estudiante_clase_id){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        
        if($estudiante->estaInscrito($estudiante_clase_id)){
            $practicas = SesionEstudiante::where('estudiante_clase_id', $estudiante_clase_id)
                         ->join('sesion', 'sesion.id', '=', 'sesion_estudiante.sesion_id')
                         ->join('guia_practica', 'guia_practica.id', '=', 'sesion.guia_practica_id')
                         ->select('guia_practica.id', 'sesion.semana', 'guia_practica.archivo')
                         ->orderBy('sesion.semana', 'desc')
                         ->get();
            
            return $practicas;
        }
    }
    
    public function subir(Request $request){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $sesion_estudiante_id = $request->sesion_estudiante_id;
        
        if($estudiante->accesoSesionEstudiante($sesion_estudiante_id)){
            $archivos = Input::all();
            $reglas = array(
                'file' => 'mimes:zip|max:3000',
            );
            $validation = Validator::make($archivos, $reglas);
            
            if (!$validation->fails()) {
                $file              = $request->file('file');
                $nombre_archivo    = $file->getClientOriginalName();
                
                $ruta_destino = '/'.$sesion_estudiante_id.'/'.$nombre_archivo;
                $existe_acrhivo = Storage::disk('practicasEstudiantes')->exists($ruta_destino);
                
                if(!$existe_acrhivo){
                    $archivo = Storage::disk('practicasEstudiantes')->put($ruta_destino, \File::get($file));
                    
                    $sesion_estudiante = SesionEstudiante::find($sesion_estudiante_id);

                    $envio_practica = new EnvioPractica;
                    $envio_practica->sesion_estudiante_id = $sesion_estudiante_id;
                    $envio_practica->en_laboratorio       = $sesion_estudiante->estaEnLaboratorio();
                    $envio_practica->archivo              = $nombre_archivo;
                    $envio_practica->save();
                    
                    return response()->json(['exito'=>['Archivo subido con éxito'], 'archivo'=>$envio_practica], 200);
                }
                else
                    return response()->json(['error'=>['Ya subiste un archivo con ese nombre']], 400);
            }
            return response()->json(['error'=>['Archivo no válido']], 400);
        }
    }
    
    public function borrar(Request $request)
    {
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        $envio_practica_id = $request->envio_practica_id;
        
        if($estudiante->accesoEnvioPractica($envio_practica_id)){
            $envio_practica = EnvioPractica::find($envio_practica_id);
            $ruta_destino = '/'.$envio_practica->sesion_estudiante_id.'/'.$envio_practica->archivo;
            Storage::disk('practicasEstudiantes')->delete($ruta_destino);
            $envio_practica->delete();
            
            return response()->json(['exito'=>['Éxito al remover el envío']], 200);
        }
        
        return response()->json(['error'=>['No tienes acceso']], 200);
    }
    
    public function descargar(Request $request, $envio_practica_id)
    {
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();

        if($estudiante->accesoEnvioPractica($envio_practica_id)){
            $envio_practica = EnvioPractica::find($envio_practica_id);
            $ruta_archivo   = $envio_practica->rutaArchivo();
            $existe_acrhivo = Storage::disk('practicasEstudiantes')->exists($ruta_archivo);
            
            if($existe_acrhivo){
                return response()->download(storage_path('app/practicasEstudiantes'.$ruta_archivo));
            }            
        }
    }
}