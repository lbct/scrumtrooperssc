<?php

namespace App\Http\Controllers\Sesion;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Controller
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
            'username'                => 'required|min:2',
            'password'                => 'required|min:2',
        ]);
        
        if(!$validator->fails()) {
            //Busca del usuario
            $usuario = Usuario::where('USERNAME',($request->username))->get();
            
            if(!$usuario->isEmpty())
            {
                $usuario = $usuario[0];
                if( Hash::check($request->password, $usuario->PASSWORD) )
                {
                    $rol        = strtolower($usuario->asignaRol[0]->rol->DESCRIPCION);
                    $usuarioID  = cookie('USUARIO_ID', $usuario->ID, 90);
                    $rolUsuario = cookie('ROL', $rol, 90);
                    
                    //Redirije a la ruta iniclal del Rol
                    return redirect('/'.$rol)->withCookie($usuarioID)->withCookie($rolUsuario);
                }
            }
            
            $request->session()->flash('alert-danger', 'Usuario o Contraseña Incorrecta');
        }
        
        return redirect('login')->withErrors($validator)->withInput();
    }
    
    public function getLogout(Request $request)
    {        
        return redirect('/login')->withCookie(\Cookie::forget('USUARIO_ID'))->withCookie(\Cookie::forget('ROL'));
    }
}