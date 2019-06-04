<?php

namespace App\Http\Controllers\Estudiante\Eliminar;

use App\Models\Usuario;
use App\Models\Clase;
use App\Models\Estudiante;
use App\Models\EstudianteClase;
use App\Models\Sesion;
use App\Models\SesionEstudiante;
use App\Models\EnvioPractica;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use Input;
use Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
 
class Control extends Base
{   
    public function deletePracticaSubida(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $usuario_id     = $request->cookie('USUARIO_ID');
            $estudiante_id  = Estudiante::where('USUARIO_ID', $usuario_id)->first()->ID;
            $archivo_id     = $request->archivo_id;
            
            $practica = EnvioPractica::find($archivo_id);
            
            if($estudiante_id != null && $practica->sesionEstudiante->ESTUDIANTE_ID == $estudiante_id)
            {
                $practica->delete();
            }
        }
    }
}
