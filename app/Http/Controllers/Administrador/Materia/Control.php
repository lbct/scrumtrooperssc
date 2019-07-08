<?php
namespace App\Http\Controllers\Administrador\Materia;

use App\Models\Usuario;
use App\Models\Materia;
use App\Models\FechaInscripcion;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function todas(Request $request, $gestion_id){
        $materias = Materia::where('gestion_id', $gestion_id)
                    ->select('id', 'codigo_materia', 'nombre_materia', 'detalle_materia')
                    ->get();
        
        return $materias;
    }
    
    public function agregar(Request $request){
        $gestion_id        = $request->gestion_id;
        $codigo_materia    = $request->codigo_materia;
        $nombre_materia    = $request->nombre_materia;
        $detalle_materia   = $request->detalle_materia;
        
        $materia = new Materia;
        $materia->gestion_id       = $gestion_id;
        $materia->codigo_materia   = $codigo_materia;
        $materia->nombre_materia   = $nombre_materia;
        $materia->detalle_materia  = $detalle_materia;
        $materia->save();        
        
        return $materia;
    }
    
    public function editar(Request $request){
        $materia_id        = $request->materia_id;
        $codigo_materia    = $request->codigo_materia;
        $nombre_materia    = $request->nombre_materia;
        $detalle_materia   = $request->detalle_materia;
        
        $materia = Materia::find($materia_id);
        $materia->codigo_materia   = $codigo_materia;
        $materia->nombre_materia   = $nombre_materia;
        $materia->detalle_materia  = $detalle_materia;
        $materia->save();    
        
        return $materia;
    }
    
    public function borrar(Request $request){
        $materia_id = $request->materia_id;
        
        $materia = Materia::find($materia_id);
        $materia->delete();        
        
        return $materia;
    }
}