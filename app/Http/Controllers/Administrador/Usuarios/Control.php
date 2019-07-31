<?php
namespace App\Http\Controllers\Administrador\Usuarios;

use App\Models\Usuario;
use App\Models\Materia;
use App\Models\AsignaRol;
use App\Models\Administrador;
use App\Models\Docente;
use App\Models\Auxiliar;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function informacion(Request $request, $usuario_id){
        $usuario = Usuario::find($usuario_id);
        
        if($usuario){
            $usuario['roles'] = $usuario->roles();
            
            if($usuario->tieneRol(5))
                $usuario['estudiante'] = $usuario->estudiante;
        }
        
        return $usuario;
    }
    
    public function agregar(Request $request){
        $usuario_form = $request->usuario;
        $usuario_username = $usuario_form['username'];
        
        $usuario_con_username = Usuario::where('username', $usuario_username)
                                ->first();

        if(!$usuario_con_username){
            $validator = Validator::make($usuario_form, [
                'username'                  => 'required|min:5',
                'password'                  => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|email|min:8',
            ]);
            
            if(!$validator->fails()){
                $roles = $usuario_form['roles'];
                
                if(sizeof($roles) >= 1){
                    $usuario = new Usuario;
                    $usuario->username = $usuario_username;
                    $usuario->nombre   = $usuario_form['nombre'];
                    $usuario->apellido = $usuario_form['apellido'];
                    $usuario->correo   = $usuario_form['correo'];
                    $usuario->password = Hash::make($usuario_form['password']);
                    $usuario->save();

                    foreach($roles as $rol){
                        $asigna_rol = new AsignaRol;
                        $asigna_rol->usuario_id = $usuario->id;
                        $asigna_rol->rol_id     = $rol['id'];
                        $asigna_rol->save();

                        if($rol['id'] == 1){
                            $administrador = new Administrador;
                            $administrador->usuario_id = $usuario->id;
                            $administrador->save();
                        }else if($rol['id'] == 2){
                            $docente = new Docente;
                            $docente->usuario_id = $usuario->id;
                            $docente->save();
                        }
                        else if($rol['id'] == 3 || $rol['id'] == 4){
                            $auxiliar = new Auxiliar;
                            $auxiliar->usuario_id = $usuario->id;
                            $auxiliar->save();
                        }
                        else if($rol['id'] == 5){
                            $estudiante = new Estudiante;
                            $estudiante->usuario_id = $usuario->id;
                            $estudiante->codigo_sis = $usuario_form['codigo_sis'];
                            $estudiante->save();
                        }
                    }
                    return response()->json(['exito'=>["Usuario Creado con éxito"]], 200);
                }
                return response()->json(['error'=>["Es al menos necesario un Rol de usuario"]], 200);
            }
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        return response()->json(['error'=>["Nombre de usuario en uso"]], 200);
    }

    public function editar(Request $request){
        $usuario_form = $request->usuario;
        $usuario_id   = $usuario_form['id'];
        $usuario_username = $usuario_form['username'];
        
        $usuario = Usuario::find($usuario_id);

        if($usuario){
            $usuario_con_username = Usuario::where('username', $usuario_username)
                                ->first();
            
            if(!$usuario_con_username || $usuario_con_username->id == $usuario_id){
                $validator = Validator::make($usuario_form, [
                    'username'                  => 'required|min:5',
                    'nombre'                    => 'required|min:2',
                    'apellido'                  => 'required|min:2',
                    'correo'                    => 'required|email|min:8',
                ]);
                
                if(!$validator->fails()){
                    $usuario->username = $usuario_username;
                    $usuario->nombre   = $usuario_form['nombre'];
                    $usuario->apellido = $usuario_form['apellido'];
                    $usuario->correo   = $usuario_form['correo'];

                    if($usuario->tieneRol(5)){
                        $codigo_sis = $usuario_form['estudiante']['codigo_sis'];
                        $estudiante = Estudiante::where('usuario_id', $usuario_id)->first();
                        $estudiante->codigo_sis = $codigo_sis;
                        $estudiante->save();
                    }

                    $usuario->save();
                    return response()->json(['exito'=>["Datos cambiados con éxito"]], 200);
                }
                return response()->json(['error'=>$validator->errors()->all()], 200);
            }
            return response()->json(['error'=>["Nombre de usuario en uso"]], 200);
        }
        return response()->json(['error'=>["El usuario no existe"]], 200);
    }
    
    public function editarPassword(Request $request){
        $usuario_id = $request->usuario_id;
        $password   = $request->password;
        $usuario    = Usuario::find($usuario_id);

        if($usuario){
            $usuario->password = Hash::make($password);
            $usuario->save();
            return response()->json(['exito'=>["Contraseña cambiada con éxito"]], 200);
        }
           
        return response()->json(['error'=>["El usuario no existe"]], 200);
    }
    
    public function borrar(Request $request){
        $usuario_id = $request->usuario_id;
        $usuario    = Usuario::find($usuario_id);
        
        if($usuario)
            $usuario->delete();
    }
}