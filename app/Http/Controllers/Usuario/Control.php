<?php

namespace App\Http\Controllers\Usuario;

use App\Models\Usuario;
use \App\Classes\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Usuario\Base;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function informacion(Request $request){
        $usuario_id = session('usuario_id');
        $usuario = Usuario::find($usuario_id);

        return $usuario;
    }
    
    public function editar(Request $request){
        $usuario_id = session('usuario_id');
        $usuario = Usuario::find($usuario_id);
        $usuario_form = $request->usuario;
        
        $validator = Validator::make($usuario_form, [
            'nombre'    => 'required|min:2',
            'apellido'  => 'required|min:2',
            'correo'    => 'required|email|min:8',
        ]);
        
        if(!$validator->fails()){
            $usuario->nombre   = $usuario_form['nombre'];
            $usuario->apellido = $usuario_form['apellido'];
            $usuario->correo   = $usuario_form['correo'];
            $usuario->save();

            return response()->json(['exito'=>["Datos cambiados con éxito"]], 200);
        }
        return response()->json(['error'=>$validator->errors()->all()], 200);
    }
    
    public function editarPassword(Request $request){
        $usuario_id = session('usuario_id');
        $usuario = Usuario::find($usuario_id);
        $usuario_form = $request->usuario;
        
        $validator = Validator::make($usuario_form, [
            'old_password'  => 'required|min:2',
            'password'      => 'required|min:2',
        ]);

        if(!$validator->fails()){
            $old_password = $usuario_form['old_password'];
            $new_passowrd = $usuario_form['password'];

            if( Hash::check($old_password, $usuario->password) ){
                $usuario->password = Hash::make($new_passowrd);
                $usuario->save();
                return response()->json(['exito'=>["Contraseña cambiada con éxito"]], 200);
            }
            return response()->json(['error'=>["Contraseña actual incorrecta"]], 200);
        }
        return response()->json(['error'=>$validator->errors()->all()], 200);
    }
}