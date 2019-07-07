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

        if($usuario_form['id'] == $usuario_id){
            $usuario->nombre   = $usuario_form['nombre'];
            $usuario->apellido = $usuario_form['apellido'];
            $usuario->correo   = $usuario_form['correo'];
            $usuario->save();

            return response()->json(['exito'=>["Datos cambiados con éxito"]], 200);
        }
        else
            return response()->json(['error'=>["No se tiene permisos para esta tarea"]], 200);
    }
    
    public function editarPassword(Request $request){
        $usuario_id = session('usuario_id');
        $usuario = Usuario::find($usuario_id);
        $usuario_form = $request->usuario;

        if($usuario_form['id'] == $usuario_id){
            $old_password = $usuario_form['old_password'];
            $new_passowrd = $usuario_form['password'];

            if( Hash::check($old_password, $usuario->password) ){
                $usuario->password = Hash::make($new_passowrd);
                $usuario->save();
                return response()->json(['exito'=>["Contraseña cambiada con éxito"]], 200);
            }
            else
                return response()->json(['error'=>["Contraseña actual incorrecta"]], 200);
        }
        else
            return response()->json(['error'=>["No se tiene permisos para esta tarea"]], 200);
    }
}