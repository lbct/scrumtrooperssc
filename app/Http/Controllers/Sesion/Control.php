<?php

namespace App\Http\Controllers\Sesion;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Classes\Sesion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class Control extends Controller
{
    //Obtiene la vista de Inicio de sesión
    public function getLogin(Request $request){
        if(Sesion::iniciado($request))
            return redirect('/panel/'.Sesion::rutaRol($request));
        
        return view('login');
    }
    
    //Inicia sesión
    public function postLogin(Request $request){
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
                
                $ruta = Sesion::rutaRol($request);

                //Redirije al panel
                return redirect('/panel/'.$ruta);
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

    public function enviarPassword(Request $request){
        
        $data = ['Hello World'];

        Mail::send([], [], function ($message) {
            $message->from('scrumtroopers@gmail.com', 'Seslab');
            $message->sender('scrumtroopers@noreply.com', 'SESLAB');
            $message->to('alex.cachnd@gmail.com', 'Alex');
            $message->replyTo('scrumtroopers@noreply.com', 'SESlab');
            $message->subject('Password Reset');
            $message->setBody('some body', 'text/html');
        }); 
        
        $request->session()->flash('alert-info', 'Correo Enviado');
    }
    
    private function rutaRol(){
        
    }
}