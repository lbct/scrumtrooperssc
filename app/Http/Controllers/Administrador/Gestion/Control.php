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
                     ->select('gestion.id', 'periodo_id', 'anho_gestion', 'descripcion as periodo', 'activa')
                     ->get();
        
        return $gestiones;
    }
    
    public function agregar(Request $request){
        $anho_gestion  = $request->anho_gestion;
        $periodo_id    = $request->periodo_id;
        
        $ultima_gestion = Gestion::orderBy('id', 'desc')
                          ->first();         
        
        $gestion = new Gestion;
        $gestion->anho_gestion = $anho_gestion;
        $gestion->periodo_id   = $periodo_id;
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
    }
    
    public function editar(Request $request){
        $gestion_id    = $request->gestion_id;
        $anho_gestion  = $request->anho_gestion;
        $periodo_id    = $request->periodo_id;
        
        $gestion = Gestion::find($gestion_id);
        $gestion->anho_gestion = $anho_gestion;
        $gestion->periodo_id   = $periodo_id;
        $gestion->save();
    }
    
    public function borrar(Request $request){
        $gestion_id = $request->gestion_id;
        
        $gestion = Gestion::find($gestion_id);
        $gestion->delete();
    }
    
    public function cambiarActiva(Request $request){
        $activa = $request->activa;
        $gestion_id     = $request->gestion_id;
        
        Gestion::where('gestion.id', '!=', $gestion_id)->update(['activa' => false]);
        $gestion = Gestion::find($gestion_id);
        $gestion->activa = $activa;
        $gestion->save();
    }
}