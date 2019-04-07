<?php
namespace App\Http\Controllers\Docente\Auxiliar\Crear;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Auxiliar;
use App\Models\Estudiante;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{   
    public function getRegistro(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return view('docente.auxiliar.crear');
        }
        
        return redirect('login');
    }
    
    public function postRegistro(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'codigo_sis'                => 'required|size:9',
            ]);
            if($validator->fails()) {
                return redirect('docente/crearAuxiliar')->withErrors($validator)->withInput();
            }
            else
            {
                $estudiante = Estudiante::where('CODIGO_SIS', '=', $request->codigo_sis)->first();
                if($estudiante == null){
                    $request->session()->flash('alert-danger', 'Codigo SIS no válido');
                    return redirect('docente/crearAuxiliar')->withErrors($validator)->withInput();
                }
                else
                {
                    $usuario = $estudiante->usuario;
                    if(Auxiliar::where('USUARIO_ID', '=', $usuario->ID)->first() == null)
                    {
                        $rol = new AsignaRol();
                        $rol -> USUARIO_ID = $usuario->ID;
                        $rol -> ROL_ID = 3;
                        $rol -> save();

                        $aux = new Auxiliar();
                        $aux -> USUARIO_ID = $usuario->ID;
                        $aux -> save();

                        $request->session()->flash('alert-success', 'Auxiliar registrado correctamente.');
                        return redirect('docente');
                    }
                    else
                    {
                        $request->session()->flash('alert-danger', 'Ya existe un Auxiliar registrado con el mismo CódigoSis');
                        return redirect('docente/crearAuxiliar')->withErrors($validator)->withInput();
                    }
                }
            }
        }
        return redirect('login');
    }
}