<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'Administrador';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}
