<?php
namespace App\Http\Controllers\Docente\Auxiliar\Crear;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Auxiliar;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\GrupoADocente;
use App\Models\GrupoDocenteAuxiliar;
use App\Models\Gestion;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{   
    //Obtiene la vista del registro para crear un nuevo Auxiliar
    public function getRegistro(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            $gestion_id = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            $usuario_id = $request->cookie('USUARIO_ID');
            $docente    = Docente::where("USUARIO_ID", $usuario_id)->first();
            
            $grupos_docentes = GrupoADocente::where("DOCENTE_ID", $docente->ID)
                             ->join("GRUPO_DOCENTE", "GRUPO_DOCENTE.ID", "=", "GRUPO_DOCENTE_ID")
                             ->join("MATERIA", "MATERIA_ID", "=", "MATERIA.ID")
                             ->where("GESTION_ID", $gestion_id)
                             ->get();
            
            //return $grupos_docentes;
        
            return view('docente.auxiliar.crear')
                   ->with("grupos_docentes", $grupos_docentes);
        }
        
        return redirect('login');
    }
    
    //Registra un nuevo Auxiliar
    public function postRegistro(Request $request)
    {
        if( $this->rol->is($request) )
        {            
            $validator = Validator::make($request->all(), [
                'username'                => 'required|min:3',
                'grupo_docente_id'        => 'required'
            ]);
            
            if($validator->fails()){
                return redirect('docente/crearAuxiliar')->withErrors($validator)->withInput();
            }
            else
            {
                $grupo_docente_id = $request->grupo_docente_id;
                $username = $request->username;
                $usuario  = Usuario::where("USERNAME", $username)->first();
                
                if($usuario!=null){
                    if($usuario->tieneRol(4)){
                        if( !$usuario->auxiliar->esAuxiliarLaboratorio($grupo_docente_id) ){
                            $auxiliar_terminal = new GrupoDocenteAuxiliar();
                            
                            $auxiliar_terminal->GRUPO_DOCENTE_ID = $grupo_docente_id;
                            $auxiliar_terminal->AUXILIAR_ID = $usuario->auxiliar->ID;
                            
                            $auxiliar_terminal->save();
                                
                            $request->session()->flash('alert-success', 'El usuario ha sido registrado con éxito');
                            return redirect('docente/crearAuxiliar');
                        }
                        else{
                            $request->session()->flash('alert-danger', 'El usuario ya está registrado en ese grupo');
                            return redirect('docente/crearAuxiliar');
                        }
                    }
                    else{
                        $request->session()->flash('alert-danger', 'El usuario indicado no tiene el rol requerido');
                        return redirect('docente/crearAuxiliar');
                    }
                }
                else{
                    $request->session()->flash('alert-danger', 'No se ha encontrado al usuario indicado');
                    return redirect('docente/crearAuxiliar');
                }
            }
        }
        return redirect('login');
    }
}