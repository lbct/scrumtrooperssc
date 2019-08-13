<?php

namespace App\Models;

use App\Models\Sesion;
use Illuminate\Database\Eloquent\Model;

class GuiaPractica extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'guia_practica';
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'guia_practica_id', 'id');
    }
    
    public function rutaArchivo()
    {
        $sesion = Sesion::where('guia_practica_id', $this->id)
                  ->join('clase', 'clase.id', '=', 'sesion.clase_id')
                  ->first();
        
        $grupo_docente_id = $sesion->grupo_docente_id;
        $semana           = $sesion->semana;
        $archivo          = $this->archivo;
        
        $ruta = '/'.$grupo_docente_id.'/'.$semana.'/'.$archivo;
        
        return $ruta;
    }
}
