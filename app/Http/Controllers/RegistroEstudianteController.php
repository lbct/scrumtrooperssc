<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistroEstudianteController extends Controller
{
    public function getRegistro()
    {
        return view('formRegistro');
    }
    
    public function postRegistro(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_sis'                => 'required|min:9|max:9',
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
            return redirect('registro')->withErrors($validator)->withInput();
        }
        else
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
            
            $rolAsignado->ROL_ID        = 4;
            $rolAsignado->USUARIO_ID    = $usuario->id;
            
            $rolAsignado->save();
            
            //Crear estudiante
            $estudiante = new Estudiante;
            
            $estudiante->USUARIO_ID     = $usuario->id;
            
            $estudiante->save();
            
            echo 'Éxito al crear el usuario';
        }
    }
}