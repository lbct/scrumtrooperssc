<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $primaryKey = 'ID';
    protected $table    = 'GESTION';
    
    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'PERIODO_ID');
    }
    
    public function materia()
    {
        return $this->hasMany('App\Models\Materia', 'GESTION_ID', 'ID');
    }
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'GESTION_ID', 'ID');
    }
}
