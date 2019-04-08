<?php
namespace App\Http\Controllers\Admin\Docente\Crear;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Docente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Control extends Base
{
    //Obtiene la vista de registro para nuevo Docente
    public function getRegistro(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return view('admin.docente.crear');
        }
        return redirect('login');
    }
    
    //Guarda los datos del registro del nuevo Administrador
    public function postRegistro(Request $request)
    {
        if( $this->rol->is($request))
        {
            $validator = Validator::make($request->all(), [
                'username'                  => 'required|min:2',
                'password'                  => 'required|min:2',
                'password_confirmation'     => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
            ]);
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if($validator->fails())
                    return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
                else
                {
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
                }
            }
            else
            {
                $cuentaCreada = Usuario::where('USERNAME',($request->username))->get();
            
                if($cuentaCreada->isEmpty())
                {
                    //Creación de usuario
                    $usuario = new Usuario();

                    $usuario->USERNAME          = $request->username;
                    $usuario->PASSWORD          = Hash::make($request->password);
                    $usuario->NOMBRE            = $request->nombre;
                    $usuario->APELLIDO          = $request->apellido;
                    $usuario->CORREO            = $request->correo;

                    $usuario->save();

                    //Añadir rol de estudiante al usuario
                    $rolAsignado = new AsignaRol;

                    $rolAsignado->ROL_ID        = 2;
                    $rolAsignado->USUARIO_ID    = $usuario->ID;

                    $rolAsignado->save();

                    //Crear estudiante
                    $docente = new Docente;

                    $docente->USUARIO_ID = $usuario->ID;

                    $docente->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    return redirect('administrador');
                }
                
                $request->session()->flash('alert-danger', 'Usuario no válido');
                return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
            }
        }
        return redirect('login');
    }
}