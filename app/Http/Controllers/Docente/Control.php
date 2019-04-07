<?php
namespace App\Http\Controllers\Docente;

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
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return view('docente.index');
        
        return redirect('login');
    }

    public function getEditar(Request $request)
    {
        if( $this->rol->is($request))
        {
            $USUARIO_ID = $request->cookie('USUARIO_ID');
            $usuario    = Usuario::find($USUARIO_ID);
            return view('docente.editar')->with('usuario', $usuario);
        }
        
        return redirect('login');
    }

    public function postEditar(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
                'password'                  => 'min:2',
                'password_confirmation'     => 'min:2',
            ]);
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if( $validator->fails() )
                    return redirect('docente/editar')->withErrors($validator)->withInput();
                else
                {
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('docente/editar');
                }
            }
            else
            {
                $USUARIO_ID = $request->cookie('USUARIO_ID');
                $usuario    = Usuario::find($USUARIO_ID);
                
                $usuario->PASSWORD          = Hash::make($request->contrasena);
                $usuario->NOMBRE            = $request->nombre;
                $usuario->APELLIDO          = $request->apellido;
                $usuario->CORREO            = $request->correo;  
                
                $usuario->save();
                $request->session()->flash('alert-success', 'Los datos fueron actualizados');
                return redirect('docente');
            }
        }
        
        return redirect('login');
    }
    
    public function getCrearAuxiliar(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return view('docente.auxiliar.crear');
        }
        
        return redirect('login');
    }
    
    public function postCrearAuxiliar(Request $request)
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