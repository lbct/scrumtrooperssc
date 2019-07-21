<?php
namespace App\Http\Controllers\Administrador\Periodo;

use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Periodo;
use App\Models\Gestion;
use App\Classes\Colecciones;
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
        
        $todos_periodos = Periodo::all();
        
        $periodos_disponibles = Colecciones::diferenciaPorId($todos_periodos, $periodos_gestion);
        
        return $periodos_disponibles;
    }
}