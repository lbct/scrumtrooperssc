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
        return view('formLogin');
    }
    
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_sis'                => 'required|min:9|max:9',
            'contrasena'                => 'required|min:2',
        ]);
        
        if(!$validator->fails()) {
            //Busca del usuario
            $usuario = Usuario::where('CODIGO_SIS',($request->codigo_sis))->get()[0];
            
            if($usuario != null)
            {
                if( Hash::check($request->contrasena, $usuario->CONTRASENA) )
                {
                    $rol        = $usuario->asignaRol->rol;
                    $usuarioID  = cookie('USUARIO_ID', $usuario->ID, 120);
                    $rolUsuario = cookie('ROL_ID', $rol->ID, 120);
                    
                    return redirect(strtolower('/'.$rol->DESCRIPCION))->withCookie($usuarioID)->withCookie($rolUsuario);
                }
            }
        }
        
        return redirect('login')->withErrors($validator)->withInput();
    }
    
    public function getLogout(Request $request)
    {        
        return redirect('/login')->withCookie(\Cookie::forget('USUARIO_ID'))->withCookie(\Cookie::forget('ROL_ID'));
    }
}