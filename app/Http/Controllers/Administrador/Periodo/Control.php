<?php
namespace App\Http\Controllers\Administrador\Periodo;

use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Periodo;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Control extends Base
{
    public function disponibles(Request $request, $anho_gestion){
        $usuario_id    = session('usuario_id');        
        $administrador = Administrador::where("usuario_id", $usuario_id)->first();
        
        $periodos_gestion = Gestion::where('anho_gestion', $anho_gestion)
                            ->select('periodo_id as id')
                            ->get();
        
        $periodos = Periodo::all();
        
        $periodos_diff = array_udiff($periodos->toArray(), $periodos_gestion->toArray(),
                                    function ($obj_a, $obj_b) {
                                        return $obj_a['id'] - $obj_b['id'];
                                    });
        
        $periodos_disponibles = collect();
        
        foreach($periodos_diff as $periodo_diff){
            $periodos_disponibles->push($periodo_diff);
        }
        
        return $periodos_disponibles;
    }
}