<?php
namespace App\Http\Controllers\Admin\Docente;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Docente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Control extends Base
{
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return view('docente.crear');
        }
        return redirect('login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request))
        {
            $validator = Validator::make($request->all(), [
                'username'                  => 'required|min:2',
                'password'                  => 'required|min:2',
                'password_confirmation'     => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
            ]);
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if($validator->fails())
                    return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
                else
                {
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
                }
            }
            else
            {
                $cuentaCreada = Usuario::where('USERNAME',($request->username))->get();
            
                if($cuentaCreada->isEmpty())
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

                    $rolAsignado->ROL_ID        = 2;
                    $rolAsignado->USUARIO_ID    = $usuario->ID;

                    $rolAsignado->save();

                    //Crear estudiante
                    $docente = new Docente;

                    $docente->USUARIO_ID = $usuario->ID;

                    $docente->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    return redirect('administrador');
                }
                
                $request->session()->flash('alert-danger', 'Usuario no válido');
                return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
            }
        }
        return redirect('login');
    }
    
    public function getLista(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $docentes = Docente::all();
            $usuarios = [];
            foreach($docentes as $docente)
            {
                array_push($usuarios, $docente -> usuario);
            }
            return view('docente.lista')->with('usuarios', $usuarios);
        }
        
        return redirect('login');
    }

    public function getVistaSimple(Request $request, $id_usuario)
    {
        if( $this->rol->is($request))
        {
            $usuario = Usuario::find($id_usuario);
            return view('docente.ver')->with('usuario', $usuario);
        }
        return redirect('login');
    }
    
    public function getEdit(Request $request, $id_usuario)
    {
        if( $this->rol->is($request) )
        {
            $usuario = Usuario::find($id_usuario);
            return view('docente.editar') -> with('usuario', $usuario);
        }
        
        return redirect('login');
    }
    
    public function postEdit(Request $request, $id_usuario)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'username'                  => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
            ]);

            if($validator->fails() )
            {
                return redirect('administrador/editarDocente/'.$id_usuario)->withErrors($validator)->withInput();
            }
            else
            {
               // $cuentaCreada = Usuario::where('USERNAME',($request->username))->get();
                
               // if( $cuentaCreada->isEmpty() )
               // {
                    $usuario = Usuario::find($id_usuario);
                
                    $usuario->USERNAME          = $request->username;
                    $usuario->NOMBRE            = $request->nombre;
                    $usuario->APELLIDO          = $request->apellido;
                    $usuario->CORREO            = $request->correo;
                    
                    $usuario->update();
                    
                    $request->session()->flash('alert-success', 'Datos del docente actualizados');
                    return redirect('administrador');
               // }
                
                //$request->session()->flash('alert-danger', 'Usuario ya existente');
                //return redirect('administrador/editarDocente/'.$id_usuario)->withErrors($validator)->withInput();
            }
        }
        
        return redirect('login');
    }
}