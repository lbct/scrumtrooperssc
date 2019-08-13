<?php
namespace App\Http\Controllers\Administrador\Gestion;

use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Gestion;
use App\Models\Materia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function todas(Request $request){
        $usuario_id    = session('usuario_id');        
        $administrador = Administrador::where("usuario_id", $usuario_id)->first();
        
        $gestiones = Gestion::join('periodo', 'periodo.id', '=', 'gestion.periodo_id')
                     ->orderBy('anho_gestion', 'desc')
                     ->orderBy('periodo.id', 'desc')
                     ->select('gestion.id', 'periodo_id', 'anho_gestion', 'descripcion as periodo', 'activa', 'inicio', 'fin')
                     ->get();
        
        foreach($gestiones as $gestion){
            $gestion['borrable'] = $gestion->esBorrable();
        }
        
        return $gestiones;
    }
    
    public function agregar(Request $request){
        $anho_gestion  = $request->anho_gestion;
        $periodo_id    = $request->periodo_id;
        $inicio        = $request->inicio;
        $fin           = $request->fin;
        
        $ultima_gestion = Gestion::orderBy('id', 'desc')
                          ->first();         
        
        $gestion_similar = Gestion::where('anho_gestion', $anho_gestion)
                           ->where('periodo_id', $periodo_id)
                           ->first();
        
        if(!$gestion_similar){
            $validator = Validator::make($request->all(), [
                'inicio'  => 'required|date',
                'fin'     => 'required|date',
            ]);
            
            if(!$validator->fails()){
                $gestion = new Gestion;
                $gestion->anho_gestion = $anho_gestion;
                $gestion->periodo_id   = $periodo_id;
                $gestion->inicio       = $inicio;
                $gestion->fin          = $fin;
                $gestion->save();

                if($ultima_gestion){
                    $materias = Materia::where('gestion_id', $ultima_gestion->id)
                                ->get();

                    foreach($materias as $materia){
                        $nueva_materia = new Materia;
                        $nueva_materia->gestion_id = $gestion->id;
                        $nueva_materia->codigo_materia = $materia->codigo_materia;
                        $nueva_materia->nombre_materia = $materia->nombre_materia;
                        $nueva_materia->detalle_materia = $materia->detalle_materia;
                        $nueva_materia->save();
                    }
                }
                return response()->json(['exito'=>["Gestión añadida con éxito."]], 200);
            }
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        return response()->json(['error'=>["Gestión duplicada."]], 200);
    }
    
    public function editar(Request $request){
        $gestion_id    = $request->gestion_id;
        $anho_gestion  = $request->anho_gestion;
        $periodo_id    = $request->periodo_id;
        $inicio        = $request->inicio;
        $fin           = $request->fin;
        
        $gestion = Gestion::find($gestion_id);
        
        if($gestion){
            $gestion_similar = Gestion::where('anho_gestion', $anho_gestion)
                               ->where('periodo_id', $periodo_id)
                               ->first();
            
            if(!$gestion_similar || $gestion_similar->id == $gestion_id){
                $validator = Validator::make($request->all(), [
                    'inicio'  => 'required|date',
                    'fin'     => 'required|date',
                ]);
                
                if(!$validator->fails()){
                    $gestion->anho_gestion = $anho_gestion;
                    $gestion->periodo_id   = $periodo_id;
                    $gestion->inicio       = $inicio;
                    $gestion->fin          = $fin;
                    $gestion->save();

                    return response()->json(['exito'=>["Gestión editada con éxito."]], 200);
                }
                return response()->json(['error'=>$validator->errors()->all()], 200);
            }
            return response()->json(['error'=>["Gestión duplicada."]], 200);
        }
        return response()->json(['error'=>['Gestión eliminada antes de la acción.']], 200);
    }
    
    public function borrar(Request $request){
        $gestion_id = $request->gestion_id;
        $gestion = Gestion::find($gestion_id);
        
        if($gestion){
            if($gestion->esBorrable()){
                $gestion->delete();
                return response()->json(['exito'=>["Gestión eliminada con éxito."]], 200);
            }
            return response()->json(['error'=>["No es posible eliminar una gestión con clases iniciadas."]], 200);
        }
        return response()->json(['exito'=>["Gestión eliminada con éxito."]], 200);
    }
    
    public function cambiarActiva(Request $request){
        $activa = $request->activa;
        $gestion_id = $request->gestion_id;
        
        $gestion = Gestion::find($gestion_id);
        
        if($gestion){
            Gestion::where('gestion.id', '!=', $gestion_id)->update(['activa' => false]);
            $gestion->activa = $activa;
            $gestion->save();
            
            if($activa)
                return response()->json(['exito'=>["Gestión Activa asignada con éxito."]], 200);
            else
                return response()->json(['advertencia'=>["Gestión desactivada con éxito."]], 200);
        }
        return response()->json(['error'=>['Gestión eliminada antes de la acción.']], 200);
    }
}