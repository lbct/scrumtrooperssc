<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'AUXILIAR';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'USUARIO_ID');
    }
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'AUXILIAR_ID', 'ID');
    }
}
