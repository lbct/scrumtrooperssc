<?php

namespace App\Http\Controllers\Docente\EnvioPractica;

use App\Models\Materia;
use App\Models\Docente;
use App\Models\GuiaPractica;
use App\Models\Sesion;
use App\Models\EnvioPractica;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Docente\Base;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function descargar(Request $request, $envio_practica_id){
        $usuario_id = session('usuario_id');        
        $docente    = Docente::where("usuario_id", $usuario_id)->first();
        
        if($docente->accesoEnvioPractica($envio_practica_id)){
            $envio_practica = EnvioPractica::find($envio_practica_id);
            $ruta_archivo   = $envio_practica->rutaArchivo();
            $existe_acrhivo = Storage::disk('practicasEstudiantes')->exists($ruta_archivo);
            
            if($existe_acrhivo){
                return response()->download(storage_path('app/practicasEstudiantes'.$ruta_archivo));
            }
        }
    }
}