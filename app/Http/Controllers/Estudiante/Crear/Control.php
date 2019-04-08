<?php

namespace App\Http\Controllers\Estudiante\Crear;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Controller
{
    //Obtiene el registro para crear un nuevo Estudiante
    public function getRegistro()
    {
        return view('estudiante.crear');
    }
    
    //Registra un nuevo Estudiante
    public function postRegistro(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'username'                  => 'required|min:5',
            'password'                  => 'required|min:2',
            'password_confirmation'     => 'required|min:2',
            'codigo_sis'                => 'required|size:9',
            'nombre'                    => 'required|min:2',
            'apellido'                  => 'required|min:2',
            'correo'                    => 'required|min:8',
        ]);
        
        if($validator->fails() || $request->password != $request->password_confirmation) 
        {
            if($validator->fails())
                return redirect('registro')->withErrors($validator)->withInput();
            else
            {
                $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                return redirect('registro')->withErrors($validator)->withInput();
            }
        }
        else
        {
            $cuentaCreada = Usuario::where('USERNAME',($request->username))->get();
            $sisCreado    = Estudiante::where('CODIGO_SIS',($request->codigo_sis))->get();
            
            if($cuentaCreada->isEmpty() && $sisCreado->isEmpty() )
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

                $rolAsignado->ROL_ID        = 4;
                $rolAsignado->USUARIO_ID    = $usuario->ID;

                $rolAsignado->save();

                //Crear estudiante
                $estudiante = new Estudiante;

                $estudiante->USUARIO_ID     = $usuario->ID;
                $estudiante->CODIGO_SIS     = $request->codigo_sis;

                $estudiante->save();

                $request->session()->flash('alert-success', 'Cuenta Creada');
                return redirect('login');
            }
            
            $request->session()->flash('alert-danger', 'Usuario o código SIS no válido');
            return redirect('registro')->withErrors($validator)->withInput();
        }
    }
}