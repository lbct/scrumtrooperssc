<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IniciarSesion extends Model
{
    protected $table = 'INICIAR_SESION';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}