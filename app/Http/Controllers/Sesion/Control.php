<?php

namespace App\Http\Controllers\Sesion;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Classes\Sesion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gregwar\Captcha\CaptchaBuilder;
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

    //Crea un Captcha y Obtiene la vista del Formulario
    public function getRecuperarCuenta(Request $request){
        session_start();
        $builder = new CaptchaBuilder;
        $builder->build();
        $img = $builder->inline();
        $_SESSION["recuperar_captcha"]=$builder->getPhrase();
        return view('recuperar')
                ->with('img', $img);
    }

    public function enviarPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'correo'                => 'required|min:12',
            'captcha'                => 'required|size:5',
        ]);

        if(!$validator->fails()) {
            session_start();
            $captcha = $_SESSION["recuperar_captcha"];

            if ($captcha == $request->captcha){

                $usuario = Usuario::where('correo', '=', $request->correo)->first();
                if (isset($usuario)){
                    $password = $this->random_str(8);
                    $data = "Hola ".$usuario->nombre." ".$usuario->apellido.'<br><br>'.
                            "SESLAB te informa que se actualizo correctamente los datos de cuenta porfavor ingresa al sistema con los siguientes datos:".'<br><br>'.
                            "Usuario: ".'<b>'.$usuario->username.'</b><br>'.
                            "Contraseña: <b>".$password."</b>";
                    try{
                        Mail::send([], ['usuario' => $usuario, 'data' => $data], function ($message) use($usuario, $data){
                        $message->from('scrumtroopers@gmail.com', 'SESLAB');
                        $message->sender('scrumtroopers@noreply.com', 'SESLAB');
                        $message->to($usuario->correo, $usuario->nombre);
                        $message->subject('Password Reset - SESLAB');
                        $message->setBody($data, 'text/html');
                        });

                        $usuario->password = Hash::make($password);
                        $usuario->save();

                        $request->session()->flash('alert-info', 'Correo Enviado');
                        return redirect('login');
                    } catch (Exception $e) {
                        $request->session()->flash('alert-danger', 'Existio un problema enviando los datos al correo');
                        return redirect('/recuperarCuenta');
                    }
                    
                }
                $request->session()->flash('alert-danger', 'No existe ninguna cuenta asociada al email');
                return redirect('/recuperarCuenta');
            }

            $request->session()->flash('alert-danger', 'El Captcha es Incorrecto');
            return redirect('/recuperarCuenta');
        }        

        return redirect('/recuperarCuenta')->withErrors($validator)->withInput();
    }
    
    private function rutaRol(){
        
    }

     /**
     * Generate a random string, using a cryptographically secure 
     * pseudorandom number generator (random_int)
     * 
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
    */
    private function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}