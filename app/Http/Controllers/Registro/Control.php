<?php
namespace App\Http\Controllers\Registro;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gregwar\Captcha\CaptchaBuilder;

class Control extends Controller
{
    public function vista()
    {
        session_start();
        $builder = new CaptchaBuilder;
        $builder->build();
        $img = $builder->inline();
        $_SESSION["text_captcha"]=$builder->getPhrase();
        return view('registro.formulario')
                ->with('img', $img);
    }
    
    //Registra un nuevo Estudiante
    public function registrar(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'username'                  => 'required|min:5',
            'password'                  => 'required|min:2',
            'password_confirmation'     => 'required|min:2',
            'codigo_sis'                => 'required|size:9',
            'nombre'                    => 'required|min:2',
            'apellido'                  => 'required|min:2',
            'correo'                    => 'required|email|min:8',
            'captcha'                   => 'required|size:5'
        ]);
        
        if($validator->fails()) 
        {
            return redirect('registro')->withErrors($validator)->withInput();
        }
        else if($request->password != $request->password_confirmation){
            $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
            return redirect('registro')->withErrors($validator)->withInput();
        }
        else
        {
            session_start();
            $captcha = $_SESSION["text_captcha"];
            if ($captcha == $request->captcha)
            {
                $cuenta_creada = Usuario::where('username',($request->username))->first();
                $sis_creado    = Estudiante::where('codigo_sis',($request->codigo_sis))->first();
                
                if(!$cuenta_creada && !$sis_creado)
                {
                    $usuario = new Usuario();
                    $usuario->username          = $request->username;
                    $usuario->password          = Hash::make($request->password);
                    $usuario->nombre            = $request->nombre;
                    $usuario->apellido          = $request->apellido;
                    $usuario->correo            = $request->correo;   
                    $usuario->save();
                    
                    $rol_asignado = new AsignaRol;
                    $rol_asignado->rol_id        = 5;
                    $rol_asignado->usuario_id    = $usuario->id;
                    $rol_asignado->save();
                    
                    $estudiante = new Estudiante;
                    $estudiante->usuario_id     = $usuario->id;
                    $estudiante->codigo_sis     = $request->codigo_sis;
                    $estudiante->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    return redirect('login');
                }
                
                $request->session()->flash('alert-danger', 'Usuario o código SIS no válido');
                return redirect('registro')->withErrors($validator)->withInput();
            }
               
            $request->session()->flash('alert-danger', 'El Captcha es Incorrecto');
            return redirect('registro')->withErrors($validator)->withInput();
        
        }
    }
}