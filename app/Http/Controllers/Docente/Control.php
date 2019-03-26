<?php
namespace App\Http\Controllers\Docente;

use App\Usuario;
use App\AsignaRol;
use App\Auxiliar;
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
            $usuario = Usuario::find($USUARIO_ID);
            return view('docente.editarActual')->with('usuario', $usuario);
        }
        return redirect('login');
    }

    public function postEditar(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            $validator = Validator::make($request->all(), [
                'codigo_sis'                => 'required|size:9',
                'contrasena'                => 'required|min:2',
                'confirmacion_contrasena'   => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
                'sexo'                      => 'required|max:1|min:1',
                'telefono'                  => 'required|min:6',
                'ci'                        => 'required|min:6',
                'fecha_nacimiento'          => 'required',
            ]);
            if($validator->fails() || $request->contrasena != $request->confirmacion_contrasena) {
                if($validator->fails())
                    return redirect('docente/editar')->withErrors($validator)->withInput();
                else{
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('docente/editar');
                }
            }
            else
            {
                $USUARIO_ID = $request->cookie('USUARIO_ID');
                $usuario = Usuario::find($USUARIO_ID);
                
                $usuario->CODIGO_SIS        = $request->codigo_sis;
                $usuario->CONTRASENA        = Hash::make($request->contrasena);
                $usuario->NOMBRE            = $request->nombre;
                $usuario->APELLIDO          = $request->apellido;
                $usuario->CORREO            = $request->correo;
                $usuario->SEXO              = $request->sexo;
                $usuario->TELEFONO          = $request->telefono;
                $usuario->CI                = $request->ci;
                $usuario->FECHA_NACIMIENTO  = $request->fecha_nacimiento;       
                
                $usuario->update();
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
            return view('auxiliar.crear');
        }
        
        return redirect('login');
    }
    
    public function postCrearAuxiliar(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            $validator = Validator::make($request->all(), [
                'codigo_sis'                => 'required|size:9',
                'contrasena'                => 'required|min:2',
                'confirmacion_contrasena'   => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
                'sexo'                      => 'required|max:1|min:1',
                'telefono'                  => 'required|min:6',
                'ci'                        => 'required|min:6',
                'fecha_nacimiento'          => 'required',
            ]);
            if($validator->fails() || $request->contrasena != $request->confirmacion_contrasena) {
                if($validator->fails())
                    return redirect('docente/crearAuxiliar')->withErrors($validator)->withInput();
                else
                    return redirect('docente/crearAuxiliar')->flash('alert-danger', 'Las contraseñas no coinciden');
            }
            else
            {
                $cuentaCreada = Usuario::all()->where('CODIGO_SIS', $request->codigo_sis);
                if($cuentaCreada == null || sizeof($cuentaCreada) <= 0)
                {
                    //Creación de usuario
                    $usuario = new Usuario();

                    $usuario->CODIGO_SIS        = $request->codigo_sis;
                    $usuario->CONTRASENA        = Hash::make($request->contrasena);
                    $usuario->NOMBRE            = $request->nombre;
                    $usuario->APELLIDO          = $request->apellido;
                    $usuario->CORREO            = $request->correo;
                    $usuario->SEXO              = $request->sexo;
                    $usuario->TELEFONO          = $request->telefono;
                    $usuario->CI                = $request->ci;
                    $usuario->FECHA_NACIMIENTO  = $request->fecha_nacimiento;       

                    $usuario->save();

                    //Añadir rol de estudiante al usuario
                    $rolAsignado = new AsignaRol;

                    $rolAsignado->ROL_ID        = 3;
                    $rolAsignado->USUARIO_ID    = $usuario->ID;

                    $rolAsignado->save();

                    //Crear estudiante
                    $auxiliar = new Auxiliar;

                    $auxiliar->USUARIO_ID     = $usuario->ID;

                    $auxiliar->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    return redirect('docente');
                }
                
                $request->session()->flash('alert-danger', 'Codigo SIS no válido');
                return redirect('docente/crearAuxiliar')->withErrors($validator)->withInput();
            }
        }
        
        return redirect('login');
    }
}