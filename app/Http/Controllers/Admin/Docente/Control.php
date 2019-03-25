<?php
namespace App\Http\Controllers\Admin\Docente;

use App\Usuario;
use App\AsignaRol;
use App\Docente;
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
                return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
            }
            else
            {
                $cuentaCreada = Usuario::where('CODIGO_SIS',($request->codigo_sis))->get();
            
                if($cuentaCreada->isEmpty())
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

                    $rolAsignado->ROL_ID        = 2;
                    $rolAsignado->USUARIO_ID    = $usuario->ID;

                    $rolAsignado->save();

                    //Crear estudiante
                    $docente = new Docente;

                    $docente->USUARIO_ID     = $usuario->ID;

                    $docente->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    return redirect('administrador');
                }
                
                $request->session()->flash('alert-danger', 'Codigo SIS no válido');
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
                'contrasena'                => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
                'telefono'                  => 'required|min:6',
                'ci'                        => 'required|min:6',
                'fecha_nacimiento'          => 'required',
            ]);

            if($validator->fails() || $request->contrasena != $request->confirmar_contrasena) {
                return redirect('administrador/editarDocente/'.$id_usuario)->withErrors($validator)->withInput();
            }
            else
            {
                $usuario = User::find($id_usuario);
                
                $usuario->CONTRASENA        = Hash::make($request->contrasena);
                $usuario->NOMBRE            = $request->nombre;
                $usuario->APELLIDO          = $request->apellido;
                $usuario->CORREO            = $request->correo;
                $usuario->TELEFONO          = $request->telefono;
                $usuario->CI                = $request->ci;
                $usuario->FECHA_NACIMIENTO  = $request->fecha_nacimiento;       
                
                $usuario->save();
                return redirect('administrador');
            }
        }
        
        return redirect('login');
    }
}