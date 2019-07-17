<?php

namespace App\Http\Controllers\AuxiliarTerminal\GuiaPractica;

use App\Models\Materia;
use App\Models\Docente;
use App\Models\GuiaPractica;
use App\Models\Auxiliar;
use App\Models\SesionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use \App\Classes\FechasInscripciones;
use \App\Classes\Dias;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AuxiliarTerminal\Base;
use Illuminate\Support\Facades\Storage;
use Input;

class Control extends Base
{
    public function descargar(Request $request, $guia_practica_id){
        $usuario_id = session('usuario_id');        
        $auxiliar   = Auxiliar::where("usuario_id", $usuario_id)->first();
        
        if($auxiliar->accesoGuiaPractica($guia_practica_id)){
            $guia_practica = GuiaPractica::find($guia_practica_id);
            $ruta_archivo = $guia_practica->rutaArchivo();
            $existe_archivo = Storage::disk('guiasPracticas')->exists($ruta_archivo);
            
            if($existe_archivo){
                return response()->download(storage_path('app/guiasPracticas'.$ruta_archivo));
            }
        }
    }
}