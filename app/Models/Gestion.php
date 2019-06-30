<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $primaryKey = 'id';
    protected $table      = 'gestion';
    
    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'periodo_id');
    }
    
    public function materia()
    {
        return $this->hasMany('App\Models\Materia', 'gestion_id', 'id');
    }
    
    public function clase()
    {
        return $this->hasMany('App\Models\Clase', 'gestion_id', 'id');
    }
}
