<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'MATERIA';
    
    public function gestion()
    {
        return $this->belongsTo('App\Models\Gestion', 'GESTION_ID');
    }
    
    public function grupoDocente()
    {
        return $this->hasMany('App\Models\GrupoDocente', 'MATERIA_ID', 'ID');
    }
}
