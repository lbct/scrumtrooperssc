<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngresoUsuarioController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_sis'                => 'required|min:9|max:9',
            'contrasena'                => 'required|min:2',
        ]);
        
        if($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }
        else
        {
            //Busca del usuario
            $usuario = Usuario::where('CODIGO_SIS',($request->codigo_sis))->get();
            
            if($usuario != null)
            {
                if( Hash::check($request->contrasena, $usuario[0]->CONTRASENA) )
                    echo 'Hola '.$usuario[0]->NOMBRE;
                else
                    return redirect('login')->withErrors($validator)->withInput();
            }
            else
                return redirect('login')->withErrors($validator)->withInput();
        }
    }
}