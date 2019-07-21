<?php
namespace App\Http\Controllers\Administrador\Aula;

use App\Models\Usuario;
use App\Models\Aula;
use App\Models\FechaInscripcion;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function todas(Request $request){
        $aulas = Aula::select('id', 'codigo_aula', 'nombre_aula', 'detalle_aula')
                 ->get();
        
        return $aulas;
    }
    
    public function cantidad(Request $request){
        $aulas = Aula::all();
        $cantidad = $aulas->count();
        return $cantidad;
    }
    
    public function agregar(Request $request){
        $codigo_aula    = $request->codigo_aula;
        $nombre_aula    = $request->nombre_aula;
        $detalle_aula   = $request->detalle_aula;
        
        $validator = Validator::make($request->all(), [
            'codigo_aula'  => 'required|min:2|unique:aula',
            'nombre_aula'  => 'required|min:2',
            'detalle_aula' => 'required|min:2',
        ]);
        
        if(!$validator->fails()){
            $aula = new Aula;
            $aula->codigo_aula   = $codigo_aula;
            $aula->nombre_aula   = $nombre_aula;
            $aula->detalle_aula  = $detalle_aula;
            $aula->save();
            
            return response()->json(['exito'=>["Aula añadida con éxito."], 'aula'=>$aula], 200);
        }
        return response()->json(['error'=>$validator->errors()->all()], 200);
    }
    
    public function editar(Request $request){
        $aula_id        = $request->aula_id;
        $codigo_aula    = $request->codigo_aula;
        $nombre_aula    = $request->nombre_aula;
        $detalle_aula   = $request->detalle_aula;
        
        $aula = Aula::find($aula_id);
        
        if($aula){
            $validator = Validator::make($request->all(), [
                'codigo_aula'  => 'required|min:2',
                'nombre_aula'  => 'required|min:2',
                'detalle_aula' => 'required|min:2',
            ]);
            
            if(!$validator->fails()){
                $aula_con_codigo = Aula::where('codigo_aula', $codigo_aula)->first();
                if(!$aula_con_codigo || $aula_con_codigo->id == $aula_id){
                    $aula->codigo_aula   = $codigo_aula;
                    $aula->nombre_aula   = $nombre_aula;
                    $aula->detalle_aula  = $detalle_aula;
                    $aula->save();
                    
                    return response()->json(['exito'=>["Aula editada con éxito."]], 200);
                }
                return response()->json(['error'=>['El Código del Aula ya ha sido tomado.']], 200);
            }
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        return response()->json(['error'=>['La Aula ha sido eliminada antes de esta acción.']], 200);
    }
    
    public function borrar(Request $request){
        $aula_id = $request->aula_id;
        
        $aula = Aula::find($aula_id);
        if($aula)
            $aula->delete();
        
        return response()->json(['exito'=>["Aula eliminada con éxito."]], 200);
    }
}