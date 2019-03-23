<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'DOCENTE';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}
