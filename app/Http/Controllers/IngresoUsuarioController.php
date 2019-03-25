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
    public function getLogin(Request $request)
    {
        $rol = $request->cookie('ROL');
        
        if( $rol != null )
            return redirect('/'.$rol);
        
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo_sis'                => 'required|min:9|max:9',
            'contrasena'                => 'required|min:2',
        ]);
        
        if(!$validator->fails()) {
            //Busca del usuario
            $usuario = Usuario::where('CODIGO_SIS',($request->codigo_sis))->get();
            
            if(!$usuario->isEmpty())
            {
                $usuario = $usuario[0];
                if( Hash::check($request->contrasena, $usuario->CONTRASENA) )
                {
                    $rol        = strtolower($usuario->asignaRol->rol->DESCRIPCION);
                    $usuarioID  = cookie('USUARIO_ID', $usuario->ID, 120);
                    $rolUsuario = cookie('ROL', $rol, 120);
                    
                    //Redirije a la ruta iniclal del Rol
                    return redirect('/'.$rol)->withCookie($usuarioID)->withCookie($rolUsuario);
                }
            }
            
            $request->session()->flash('alert-danger', 'Usuario Incorrecto');
        }
        
        return redirect('login')->withErrors($validator)->withInput();
    }
    
    public function getLogout(Request $request)
    {        
        return redirect('/login')->withCookie(\Cookie::forget('USUARIO_ID'))->withCookie(\Cookie::forget('ROL'));
    }
}