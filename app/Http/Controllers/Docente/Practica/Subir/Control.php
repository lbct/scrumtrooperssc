<?php
namespace App\Http\Controllers\Docente\Practica\Subir;

use App\Models\Usuario;
use App\Models\Sesion;
use App\Models\GuiaPractica;
use App\Models\Materia;
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
    public function postConfirmar(Request $request){
        $usuarioId = $request->cookie('USUARIO_ID');
        $ubicacion_archivo = $request->ubicacion_guia_practica;
<<<<<<< HEAD
        $clase_id = $request->clase_id;
=======
        $grupo_a_docente_id = $request->grupo_a_docente_id;
>>>>>>> origin
        $semana_valor = $request->semana_valor;
        $auxiliar_id = $request->auxiliar_id;
        $gestion_id = $request->gestion_id;

        if($ubicacion_archivo != null){
            $guiaPractica = GuiaPractica::where('ARCHIVO', '=', $ubicacion_archivo)->get()->first();
<<<<<<< HEAD

            $sesiones = Sesion::whereRaw('CLASE_ID='.$clase_id.' AND SEMANA='.$semana_valor)->get();
            
            if($sesiones == null || sizeof($sesiones) == 0){
                $sesion = new Sesion();
                $sesion->CLASE_ID = $clase_id;
                //$sesion->AUXILIAR_ID = $auxiliar_id;
                $sesion->GUIA_PRACTICA_ID = $guiaPractica->ID;
                $sesion->SEMANA = $semana_valor;
                $sesion->save();
            }
            else{
                $sesion = $sesiones->first();
                //$sesion->AUXILIAR_ID = $auxiliar_id;
                $sesion->GUIA_PRACTICA_ID = $guiaPractica->ID;
                $sesion->update();
            }
            $request->session()->flash('alert-success', 'Sesión Creada correctamente');
=======
            $clases = Clase::where('CLASE.GRUPO_A_DOCENTE_ID', '=', $grupo_a_docente_id)->get();
            $actualizacion = false;
            foreach($clases as $clase){
                $sesiones = Sesion::whereRaw('CLASE_ID='.$clase->ID.' AND SEMANA='.$semana_valor)->get();
                if($sesiones == null || sizeof($sesiones) == 0){
                    $sesion = new Sesion();
                    $sesion->CLASE_ID = $clase->ID;
                    //$sesion->AUXILIAR_ID = $auxiliar_id;
                    $sesion->GUIA_PRACTICA_ID = $guiaPractica->ID;
                    $sesion->SEMANA = $semana_valor;
                    $sesion->save();
                }
                else{
                    $actualizacion = true;
                    $sesion = $sesiones->first();
                    //$sesion->AUXILIAR_ID = $auxiliar_id;
                    $sesion->GUIA_PRACTICA_ID = $guiaPractica->ID;
                    $sesion->update();
                }
            }
            if($actualizacion === false)
                $request->session()->flash('alert-success', 'Sesión Creada correctamente');
            else
                $request->session()->flash('alert-success', 'Sesión Actualizada correctamente');
>>>>>>> origin
        }
        else {
            $request->session()->flash('alert-danger', 'Debe subir un archivo para crear la sesión');
        }
        return redirect('docente/subirPractica');
    }

    public function postSubir(Request $request){
        $usuarioId = $request->cookie('USUARIO_ID');
        
        $input = Input::all();
 
        $rules = array(
            'file' => 'required|mimes:zip,rar,7z,doc,docx,xls,xlsx,pdf',
        );
        
        $validation = Validator::make($input, $rules);
 
        if ($validation->fails()) {
            return Response::make($validation->errors()->first(), 400);
        }

        
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = $request->nombre_archivo. '.' . $extension; // renameing image
        
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        
        if ($upload_success) {
            $existe = GuiaPractica::where('ARCHIVO', '=', $destinationPath.'/'.$fileName)
            ->get();
            if($existe == null || sizeof($existe) == 0){
                $guiaPractica = new GuiaPractica();
                $guiaPractica->ARCHIVO = $destinationPath.'/'.$fileName;
                $guiaPractica->save();
            }
            return Response::json('success', 200);
        } else 
        {
            return Response::json('error', 400);
        }
    }
}