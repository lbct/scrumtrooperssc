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
    //Obtiene la vista de Inicio de sesión
    public function getLogin(Request $request)
    {
        return view('login');
    }
    
    //Inicia sesión
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'                => 'required|min:2',
            'password'                => 'required|min:2',
        ]);
        
        if(!$validator->fails()) {
            //Busca del usuario
            $usuario  = Usuario::where('username',($request->username))->first();
            $password = $request->password;
            
            if( $usuario!==null && $usuario->revisarPassword($password) )
            {
                //inicia la sesion
                session(['usuario_id' => $usuario->id]);

                //Redirije al panel
                return redirect('/panel');
            }
            
            $request->session()->flash('alert-danger', 'Usuario o Contraseña Incorrecta');
        }
        
        return redirect('login')->withErrors($validator)->withInput();
    }
    
    //Cierra sesión
    public function getLogout(Request $request)
    {        
        $request->session()->flush();
        return redirect('/login');
    }
}