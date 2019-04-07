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
            return view('admin.docente.crear');
        }
        return redirect('login');
    }

    public function getEditarClave(Request $request, $id_usuario){
        if( $this->rol->is($request) )
        {
            return view('admin.docente.editar.clave')
            ->with('id_usuario', $id_usuario);
        }
        return redirect('login');
    }

    public function postEditarClave(Request $request, $id_usuario){
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'password'                  => 'required|min:2',
                'password_confirmation'     => 'required|min:2',
            ]);
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if($request->password != $request->password_confirmation)
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                return redirect('/administrador/editarDocente/'.$id_usuario.'/cambiarClave')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                $usuario = Usuario::find($id_usuario);
                $usuario->PASSWORD = Hash::make($request->password);
                $usuario->update();
                $request->session()->flash('alert-success', 'La contraseña se cambió correctamente.');
                return view('admin.docente.editar.usuario')
                ->with('usuario', $usuario);
            }
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
            return view('admin.docente.ver.lista')->with('usuarios', $usuarios);
        }
        
        return redirect('login');
    }

    public function getVistaSimple(Request $request, $id_usuario)
    {
        if( $this->rol->is($request))
        {
            $usuario = Usuario::find($id_usuario);
            return view('admin.docente.ver.usuario')->with('usuario', $usuario);
        }
        return redirect('login');
    }
    
    public function getEdit(Request $request, $id_usuario)
    {
        if( $this->rol->is($request) )
        {
            $usuario = Usuario::find($id_usuario);
            return view('admin.docente.editar.usuario') -> with('usuario', $usuario);
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
                $usuario_actual = Usuario::where('ID', $id_usuario)->first();
                $existeCuenta = Usuario::where('USERNAME',($request->username))->first() != null 
                && $usuario_actual->USERNAME != $request->username;
                if($existeCuenta){
                    $request->session()->flash('alert-danger', 'El nombre de usuario '.$request->username.' ya está siendo utilizado.');
                    return redirect('administrador/editarDocente/'.$id_usuario)->withErrors($validator)->withInput();
                }
                else{
                    $usuario_actual->USERNAME          = $request->username;
                    $usuario_actual->NOMBRE            = $request->nombre;
                    $usuario_actual->APELLIDO          = $request->apellido;
                    $usuario_actual->CORREO            = $request->correo;
                    $usuario_actual->update();
                    $request->session()->flash('alert-success', 'Datos del docente actualizados');
                    return redirect('administrador');
                }
            }
        }
        return redirect('login');
    }
}