<?php
namespace App\Http\Controllers\Admin;

use App\Usuario;
use App\AsignaRol;
use App\Administrador;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return view('admin.index');
        
        return redirect('login');
    }
    
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return view('admin.crear');
        }
        
        return redirect('login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request) )
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
                    return redirect('administrador/crearAdmin')->withErrors($validator)->withInput();
                else{
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('administrador/crearAdmin');
                }
            }
            else
            {
                $cuentaCreada = Usuario::where('CODIGO_SIS',($request->codigo_sis))->get();
            
                if($cuentaCreada->isEmpty())
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

                    $rolAsignado->ROL_ID        = 1;
                    $rolAsignado->USUARIO_ID    = $usuario->ID;

                    $rolAsignado->save();

                    //Crear estudiante
                    $administrador = new Administrador;

                    $administrador->USUARIO_ID     = $usuario->ID;

                    $administrador->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    
                    return redirect('administrador');
                }
                
                $request->session()->flash('alert-danger', 'Codigo SIS no válido');
                return redirect('administrador/crearAdmin')->withErrors($validator)->withInput();
            }
        }
        
        return redirect('login');
    }
}