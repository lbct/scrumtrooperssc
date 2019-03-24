<?php
namespace App\Http\Controllers\Estudiante;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Controller
{
    public function isEstudiante(Request $request)
    {
        $ROL_ID     = $request->cookie('ROL_ID');
        $estudiante = false;
        
        if( $ROL_ID == 4 )
            $estudiante = true;
        
        return $estudiante;
    }
    
    public function getVista(Request $request)
    {
        if( $this->isEstudiante($request) )
            return view('welcome');
        
        return redirect('login');
    }
    
    public function getEdit(Request $request)
    {
        if( $this->isEstudiante($request) )
        {
            $USUARIO_ID = $request->cookie('USUARIO_ID');
            $usuario = Usuario::find($USUARIO_ID);
            
            return view('estudiante\formEditar')->with('usuario', $usuario);
        }
        
        return redirect('login');
    }

    public function postEdit(Request $request)
    {
        if( $this->isEstudiante($request) )
        {
            $validator = Validator::make($request->all(), [
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
                'sexo'                      => 'required|max:1|min:1',
                'telefono'                  => 'required|min:6',
                'ci'                        => 'required|min:6',
                'fecha_nacimiento'          => 'required',
            ]);
            
            if($validator->fails() || $request->contrasena != $request->confirmacion_contrasena) {
                return redirect('/estudiante/editar')->withErrors($validator)->withInput();
            }
            else
            {
                //Edición de usuario
                $USUARIO_ID = $request->cookie('USUARIO_ID');
                $usuario = Usuario::find($USUARIO_ID);
                
                if( $request->contrasena!=null )
                    $usuario->CONTRASENA        = Hash::make($request->contrasena);
                
                $usuario->NOMBRE            = $request->nombre;
                $usuario->APELLIDO          = $request->apellido;
                $usuario->CORREO            = $request->correo;
                $usuario->SEXO              = $request->sexo;
                $usuario->TELEFONO          = $request->telefono;
                $usuario->CI                = $request->ci;
                $usuario->FECHA_NACIMIENTO  = $request->fecha_nacimiento;
                
                $usuario->save();

                return 'Éxito al editar el usuario';
            }
        }
            
        return redirect('login');
    }
}