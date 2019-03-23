<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'ESTUDIANTE';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}
