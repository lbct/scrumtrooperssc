<?php
namespace App\Http\Controllers\Docente\Sesion;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Sesion;
use App\Models\Clase;
use App\Models\GrupoDocente;
use App\Models\GuiaPractica;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function sesiones(Request $request, $grupo_docente_id){
        $usuario_id = session('usuario_id'); 
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoGrupoDocente($grupo_docente_id)){
            $grupo_docente = GrupoDocente::find($grupo_docente_id);
            return $grupo_docente->sesiones();
        }
    }
    
    public function agregar(Request $request){
        $usuario_id = session('usuario_id');        
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $grupo_docente_id = $request->grupo_docente_id;
        
        if($docente->accesoGrupoDocente($grupo_docente_id)){            
            $archivos = Input::all();
            $reglas = array(
                'file' => 'required|mimes:zip,rar,pdf|max:5000',
            );
            $validation = Validator::make($archivos, $reglas);
            
            if (!$validation->fails()) {
                $grupo_docente     = GrupoDocente::find($grupo_docente_id);
                $file              = $request->file('file');
                $nombre_archivo    = $file->getClientOriginalName();
                
                if($grupo_docente->tieneClases()){
                    $semana            = $grupo_docente->maximaSemana()+1;
                    $ruta_destino = '/'.$grupo_docente_id.'/'.$semana.'/'.$nombre_archivo;                
                    $archivo = Storage::disk('guiasPracticas')->put($ruta_destino, \File::get($file));

                    $guia_practica = new GuiaPractica;
                    $guia_practica->archivo = $nombre_archivo;
                    $guia_practica->save();

                    $clases = $grupo_docente->clase;
                    foreach($clases as $clase){
                        $clase->agregarSesion($guia_practica->id, $semana);
                    }

                    return response()->json(['exito'=>['Guía Práctica añadida con éxito']], 200);
                }
                return response()->json(['error'=>['No se tiene clases disponibles']], 400);
            }
            return response()->json(['error'=>['Archivo no válido']], 400);
        }
    }
    
    public function editar(Request $request){
        $usuario_id = session('usuario_id');        
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $sesion_id  = $request->sesion_id;
        
        if($docente->accesoSesion($sesion_id)){
            $archivos = Input::all();
            $reglas = array(
                'file' => 'required|mimes:zip,rar,pdf|max:5000',
            );
            $validation = Validator::make($archivos, $reglas);
            
            if (!$validation->fails()) {
                $sesion            = Sesion::find($sesion_id);
                $file              = $request->file('file');
                $nombre_archivo    = $file->getClientOriginalName();
                $semana            = $sesion->semana;
                $grupo_docente_id  = $sesion->clase->grupo_docente_id;
                
                $ruta_destino = '/'.$grupo_docente_id.'/'.$semana.'/'.$nombre_archivo;                
                $archivo = Storage::disk('guiasPracticas')->put($ruta_destino, \File::get($file));

                $guia_practica = GuiaPractica::find($sesion->guia_practica_id);
                $guia_practica->archivo = $nombre_archivo;
                $guia_practica->save();

                return response()->json(['exito'=>['Guía Práctica editada con éxito']], 200);
            }
            return response()->json(['error'=>['Archivo no válido']], 400);
        }
    }
    
    public function borrar(Request $request){
        $usuario_id = session('usuario_id');        
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        $sesion_id  = $request->sesion_id;
        
        if($docente->accesoSesion($sesion_id)){
            $sesion = Sesion::find($sesion_id);
            
            if($sesion->esBorrable()){
                $semana           = $sesion->semana;
                $grupo_docente_id = $sesion->clase->grupo_docente_id;
                $clases           = Clase::where('grupo_docente_id', $grupo_docente_id)
                                    ->get();
                
                foreach($clases as $clase){
                    $misma_semana = Sesion::where('clase_id', $clase->id)
                                    ->where('sesion.semana', $semana)
                                    ->delete();
                }
                
                foreach($clases as $clase){
                    $siguientes_semanas = Sesion::where('clase_id', $clase->id)
                                          ->where('sesion.semana', '>', $semana)
                                          ->get();
                    
                    foreach($siguientes_semanas as $siguiente_semana){
                        $sesion_siguiente_semana = Sesion::find($siguiente_semana->id);
                        $sesion_siguiente_semana->semana = $sesion_siguiente_semana->semana-1;
                        $sesion_siguiente_semana->save();
                    }
                }
                
                return response()->json(['exito'=>['Semana borrada con éxito']], 200);
            }
            return response()->json(['error'=>['No es posible borrar esta semana porque ya ha sido avanzada por alguna clase']], 200);
        }
    }
}