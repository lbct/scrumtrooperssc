<?php

namespace App\Http\Controllers\Estudiante\Subir;

use App\Models\Usuario;
use App\Models\Clase;
use App\Models\EstudianteClase;
use App\Models\Sesion;
use App\Models\SesionEstudiante;
use App\Models\EnvioPractica;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use Input;
use Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
 
class Control extends Base
{   
    private function getUltimaGestion()
    {
        $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
        return $id_gestion;
    }
    
    //obtiene la vista del formulario para ver el portafolio del estudiante con sesion iniciada
    public function verClases(Request $request)
    {
        if ($this->rol->is($request)) {
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;
            
            $gestion_actual = $this->getUltimaGestion();
            
            $clases  = EstudianteClase::where("ESTUDIANTE_ID", $estudiante->ID)
                         ->join("CLASE", "ESTUDIANTE_CLASE.CLASE_ID", "=", "CLASE.ID")
                         ->join("GESTION", "CLASE.GESTION_ID", "=", "GESTION.ID")
                         ->where("GESTION.ID", $gestion_actual)
                         ->join("GRUPO_A_DOCENTE", "GRUPO_A_DOCENTE.ID", "=", "CLASE.GRUPO_A_DOCENTE_ID")
                         ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_A_DOCENTE.GRUPO_DOCENTE_ID")
                         ->join("MATERIA", "MATERIA.ID", "=", "GRUPO_DOCENTE.MATERIA_ID")
                         ->select("NOMBRE_MATERIA", "CLASE_ID")
                         ->get();
            
            return view('estudiante.subir.clases')
                   ->with('clases', $clases);
        }

        return redirect('login');
    }
    
    public function getSesion(Request $request)
    {
        if ($this->rol->is($request)) {
            $estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante;
            $clase_id = $request->clase_id;
            
            $estudianteClase = EstudianteClase::where('CLASE_ID', $clase_id)
                               ->where('ESTUDIANTE_ID', $estudiante->ID);
            
            if($estudianteClase->exists())
            {
                $semana_actual = Clase::find($clase_id)->SEMANA_ACTUAL_SESION;
                $sesion_id     = Sesion::where("CLASE_ID", $clase_id)
                                 ->where("SEMANA", $semana_actual)
                                 ->first()->ID;
                
                return redirect('/estudiante/subirPractica/'.strval($sesion_id));
            }

            return redirect('/estudiante/subirPractica');
        }

        return redirect('login');
    }
    
    public function getSubir(Request $request, $id_sesion)
    {
        if( $this->rol->is($request) )
        {
            $sesion  = Sesion::find($id_sesion);
            $semana_actual = $sesion->clase->SEMANA_ACTUAL_SESION;
            $id_estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante->ID;
            
            $estudianteClase = EstudianteClase::where('CLASE_ID', $sesion->clase->ID)
                               ->where('ESTUDIANTE_ID', $id_estudiante);
            
            if( $sesion->SEMANA <= $semana_actual && $estudianteClase->exists() )
            {
                $sesion_estudiante = SesionEstudiante::where('SESION_ID',$id_sesion)
                                     ->where('ESTUDIANTE_ID',$id_estudiante)
                                     ->first();
                
                $envios = EnvioPractica::where('SESION_ESTUDIANTE_ID',$sesion_estudiante->ID)->get();
                
                $semanas = Sesion::where("SESION.CLASE_ID", $sesion->CLASE_ID)
                           ->orderBy("SESION.SEMANA", "DESC")
                           ->where("SESION.SEMANA", "<=", $semana_actual)
                           ->get();
                
                return view('estudiante.subir.practica')
                ->with('sesion', $sesion)
                ->with('envios', $envios)
                ->with('semanas', $semanas);
            }
            
            return redirect('/estudiante/subirPractica');
        }
        
        return redirect('login');
    }

    public function postSubir(Request $request, $id_sesion)
    {
        if( $this->rol->is($request) )
        {
            $sesion  = Sesion::find($id_sesion);
            
            $semana_actual = $sesion->clase->SEMANA_ACTUAL_SESION;
            $id_estudiante = Usuario::find($request->cookie('USUARIO_ID'))->estudiante->ID;
            
            $estudianteClase = EstudianteClase::where('CLASE_ID', $sesion->clase->ID)
                               ->where('ESTUDIANTE_ID', $id_estudiante);
            
            if( $sesion->SEMANA <= $semana_actual && $estudianteClase->exists() )
            {
                $id_grupoDocente = $sesion->clase->grupoADocente->grupoDocente->ID;
                $id_clase        = $sesion->clase->ID;
                $user            = $request->cookie('USUARIO_ID');

                $input = Input::all();

                $rules = array(
                    'file' => 'mimes:zip|max:3000',
                );

                $validation = Validator::make($input, $rules);

                if ($validation->fails()) {
                    return Response::make($validation->errors()->first(), 400);
                }

                $trabajo = Input::file('file');

                $destinationPath = "/".$id_grupoDocente."/".$id_clase."/".$id_sesion."/".$user."/";

                $fileName  = $destinationPath.$trabajo->getClientOriginalName();
                $exists    = Storage::disk('practicasEstudiantes')->exists($fileName);

                if(!$exists)
                {
                    $upload_success = Storage::disk('practicasEstudiantes')->put($fileName, \File::get($trabajo));
                    
                    $sesion_estudiante = SesionEstudiante::where('SESION_ID', $id_sesion)
                                         ->where('ESTUDIANTE_ID', $id_estudiante)
                                         ->first();                
                    
                    $envio_practica    = new EnvioPractica();
                    
                    $envio_practica->SESION_ESTUDIANTE_ID = $sesion_estudiante->ID;
                    $envio_practica->EN_LABORATORIO       = true;
                    $envio_practica->ARCHIVO              = $trabajo->getClientOriginalName();
                    
                    $envio_practica->save();
                    

                    if ($upload_success) {
                        return Response::json('Exito al subir el archivo.', 200);
                    } else {
                        return Response::json('No se pudo subir el archivo.', 400);
                    }
                }
                else
                {
                    return Response::json('Ya subiste un archivo con el mismo nombre.', 400);
                }
            }
        }
        
        return redirect('login');
    }
}
