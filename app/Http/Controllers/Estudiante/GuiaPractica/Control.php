<?php

namespace App\Http\Controllers\Estudiante\GuiaPractica;

use App\Models\Materia;
use App\Models\Estudiante;
use App\Models\GuiaPractica;
use App\Models\Sesion;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function descargar(Request $request, $guia_practica_id){
        $usuario_id = session('usuario_id');        
        $estudiante = Estudiante::where("usuario_id", $usuario_id)->first();
        
        if($estudiante->accesoGuiaPractica($guia_practica_id)){
            $guia_practica = GuiaPractica::find($guia_practica_id);
            $ruta_archivo  = $guia_practica->rutaArchivo();
            $existe_archivo = Storage::disk('guiasPracticas')->exists($ruta_archivo);
            
            if($existe_archivo){
                return response()->download(storage_path('app/guiasPracticas'.$ruta_archivo));
            }          
        }
    }
}