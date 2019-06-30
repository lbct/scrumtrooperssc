<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sesion';
    
    public function clase()
    {
        return $this->belongsTo('App\Models\Clase', 'clase_id');
    }
    
    public function auxiliar()
    {
        return $this->belongsTo('App\Models\Auxiliar', 'auxiliar_id');
    }
    
    public function guiaPractica()
    {
        return $this->belongsTo('App\Models\GuiaPractica', 'guia_practica_id');
    }
    
    public function sesionEstudiante()
    {
        return $this->hasMany('App\Models\SesionEstudiante', 'sesion_id', 'id');
    }
}
