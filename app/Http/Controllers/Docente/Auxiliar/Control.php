<?php
namespace App\Http\Controllers\Docente\Auxiliar;

use App\Models\Usuario;
use App\Models\Docente;
use App\Models\AsignaRol;
use App\Models\GrupoDocenteAuxiliar;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Docente\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function disponibles(Request $request, $grupo_docente_id){
        $auxiliares_terminal = AsignaRol::where('rol_id', 4)
                               ->join('usuario', 'usuario.id', '=', 'asigna_rol.usuario_id')
                               ->join('auxiliar', 'auxiliar.usuario_id', '=', 'usuario.id')
                               ->select("auxiliar.id as id", "nombre", "apellido", "username")
                               ->get();
        
        $auxiliares_registrados = GrupoDocenteAuxiliar::where('grupo_docente_id', $grupo_docente_id)
                                  ->select('auxiliar_id as id')
                                  ->get();
            
        $auxiliares_disponibles = array_udiff($auxiliares_terminal->toArray(), $auxiliares_registrados->toArray(),
                                            function ($obj_a, $obj_b) {
                                                return $obj_a['id'] - $obj_b['id'];
                                            });
        
        return response()->json(['exito'=>$auxiliares_disponibles], 200);
    }
    
    public function asignar(Request $request){
        $grupo_docente_id     = $request->grupo_docente_id;
        $auxiliar_terminal_id = $request->auxiliar_terminal_id;
        
        $registro = new GrupoDocenteAuxiliar;
        $registro->grupo_docente_id = $grupo_docente_id;
        $registro->auxiliar_id      = $auxiliar_terminal_id;
        $registro->save();
        
        return response()->json(['exito'=>['Auxiliar asignado con éxito']], 200);
    }
    
    public function asignados(Request $request, $gestion_id){
        $usuario_id = session('usuario_id');        
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        return $docente->auxiliaresAginados($gestion_id);
    }
    
    public function retirar(Request $request){
        $grupo_docente_auxiliar_id = $request->grupo_docente_auxiliar_id;
        $registro = GrupoDocenteAuxiliar::find($grupo_docente_auxiliar_id);
        $registro->delete();
        
        return response()->json(['exito'=>['Auxiliar retirado con éxito']], 200);
    }
}