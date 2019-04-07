<?php
namespace App\Http\Controllers\Estudiante\Editar;

use App\Models\Usuario;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getEditar(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $USUARIO_ID = $request->cookie('USUARIO_ID');
            $usuario = Usuario::find($USUARIO_ID);
            
            return view('estudiante.editar')->with('usuario', $usuario);
        }
        
        return redirect('login');
    }

    public function postEditar(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
                'password'                  => 'min:2',
                'password_confirmation'     => 'min:2',
            ]);
            
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if( $validator->fails() )
                    return redirect('/estudiante/editar')->withErrors($validator)->withInput();
                else
                {
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('/estudiante/editar');
                }
            }
            else
            {
                //Edición de usuario
                $USUARIO_ID = $request->cookie('USUARIO_ID');
                $usuario    = Usuario::find($USUARIO_ID);
                
                if( $request->password!=null )
                    $usuario->PASSWORD      = Hash::make($request->password);
                $usuario->NOMBRE            = $request->nombre;
                $usuario->APELLIDO          = $request->apellido;
                $usuario->CORREO            = $request->correo;
                
                $usuario->save();
                $request->session()->flash('alert-success', 'Los datos fueron actualizados');
                return view('estudiante.index');
            }
        }
            
        return redirect('login');
    }
}