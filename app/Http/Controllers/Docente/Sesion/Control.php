<?php
namespace App\Http\Controllers\Docente\Sesion;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\Sesion;
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

                return response()->json(['exito'=>['Archivo subido con éxito']], 200);
            }
            return response()->json(['error'=>['Archivo no válido']], 400);
        }
    }
}