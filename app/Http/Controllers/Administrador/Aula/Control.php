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
    
    public function agregar(Request $request){
        $codigo_aula    = $request->codigo_aula;
        $nombre_aula    = $request->nombre_aula;
        $detalle_aula   = $request->detalle_aula;
        
        $aula = new Aula;
        $aula->codigo_aula   = $codigo_aula;
        $aula->nombre_aula   = $nombre_aula;
        $aula->detalle_aula  = $detalle_aula;
        $aula->save();        
        
        return $aula;
    }
    
    public function editar(Request $request){
        $aula_id        = $request->aula_id;
        $codigo_aula    = $request->codigo_aula;
        $nombre_aula    = $request->nombre_aula;
        $detalle_aula   = $request->detalle_aula;
        
        $aula = Aula::find($aula_id);
        $aula->codigo_aula   = $codigo_aula;
        $aula->nombre_aula   = $nombre_aula;
        $aula->detalle_aula  = $detalle_aula;
        $aula->save();        
        
        return $aula;
    }
    
    public function borrar(Request $request){
        $aula_id        = $request->aula_id;
        
        $aula = Aula::find($aula_id);
        $aula->delete();        
        
        return $aula;
    }
}