<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IniciarSesion extends Model
{
    protected $table = 'Iniciar_Sesion';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}
