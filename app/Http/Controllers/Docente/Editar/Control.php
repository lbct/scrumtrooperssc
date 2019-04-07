<?php
namespace App\Http\Controllers\Docente\Editar;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Auxiliar;
use App\Models\Estudiante;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getEditar(Request $request)
    {
        if( $this->rol->is($request))
        {
            $USUARIO_ID = $request->cookie('USUARIO_ID');
            $usuario    = Usuario::find($USUARIO_ID);
            return view('docente.editar')->with('usuario', $usuario);
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
                'correo'                    => 'required|min:8'
            ]);
            if($validator->fails())
                return redirect('docente/editar')->withErrors($validator)->withInput();
            else
            {
                $USUARIO_ID = $request->cookie('USUARIO_ID');
                $usuario    = Usuario::find($USUARIO_ID);
                
                $usuario->NOMBRE            = $request->nombre;
                $usuario->APELLIDO          = $request->apellido;
                $usuario->CORREO            = $request->correo;  
                
                $usuario->save();
                $request->session()->flash('alert-success', 'Los datos fueron actualizados');
                return redirect('docente');
            }
        }
        
        return redirect('login');
    }
}