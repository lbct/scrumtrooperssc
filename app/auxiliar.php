<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    protected $table    = 'Auxiliar';
    
    public function usuario()
    {
        return $this->hasOne('App\Usuario', 'ID', 'USUARIO_ID');
    }
}
