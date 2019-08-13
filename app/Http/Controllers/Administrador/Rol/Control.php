<?php
namespace App\Http\Controllers\Administrador\Rol;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Rol;
use App\Models\Administrador;
use App\Models\Docente;
use App\Models\Auxiliar;
use App\Models\Estudiante;
use App\Classes\Colecciones;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function todos(Request $request){
        $todos_roles = Rol::select('id', 'descripcion')->get();
        
        return $todos_roles;
    }
    
    public function disponibles(Request $request, $usuario_id){
        $usuario = Usuario::find($usuario_id);
        $roles_disponibles = collect();
        
        if($usuario){
            $todos_roles       = Rol::select('id', 'descripcion')->get();
            $roles_registrados = $usuario->roles();
            
            $roles_disponibles = Colecciones::diferenciaPorId($todos_roles, $roles_registrados);
        }
        
        return $roles_disponibles;
    }
    
    public function editar(Request $request){
        $usuario_id = $request->usuario_id;
        $roles      = $request->roles;
        
        $usuario = Usuario::find($usuario_id);
        $roles_registrados = $usuario->roles();
        
        foreach($roles_registrados as $rol_registrado){
            $encontrado = false;

            foreach($roles as $rol){
                if($rol_registrado->id == $rol['id']){
                    $encontrado = true;
                    break;
                }
            }

            if(!$encontrado){
                $registro = AsignaRol::where('rol_id', $rol_registrado->id)
                            ->where('usuario_id', $usuario_id)
                            ->first();
                
                $registro->delete();
            } 
        }
        
        foreach($roles as $rol){
            if(!$usuario->tieneRol($rol['id'])){
                $nuevo_rol_asignado = new AsignaRol;
                $nuevo_rol_asignado->usuario_id = $usuario_id;
                $nuevo_rol_asignado->rol_id     = $rol['id'];
                $nuevo_rol_asignado->save();
                
                if($rol['id'] == 1){
                    $antiguo_administrador = Administrador::where('usuario_id', $usuario_id)->first();
                    
                    if(!$antiguo_administrador){
                        $administrador = new Administrador;
                        $administrador->usuario_id = $usuario_id;
                        $administrador->save();
                    }
                }else if($rol['id'] == 2){
                    $antiguo_docente = Docente::where('usuario_id', $usuario_id)->first();
                    
                    if(!$antiguo_docente){
                        $docente = new Docente;
                        $docente->usuario_id = $usuario_id;
                        $docente->save();
                    }
                }
                else if($rol['id'] == 3 || $rol['id'] == 4){
                    $antiguo_auxiliar = Auxiliar::where('usuario_id', $usuario_id)->first();
                    
                    if(!$antiguo_auxiliar){
                        $auxiliar = new Auxiliar;
                        $auxiliar->usuario_id = $usuario_id;
                        $auxiliar->save();
                    }
                }
                else if($rol['id'] == 5){
                    $antiguo_estudiante = Estudiante::where('usuario_id', $usuario_id)->first();
                    
                    if(!$antiguo_estudiante){
                        $estudiante = new Estudiante;
                        $estudiante->usuario_id = $usuario_id;
                        $estudiante->save();
                    }
                }
            }
        }
        
        return response()->json(['exito'=>["Roles modificados con éxito"]], 200);
    }
}