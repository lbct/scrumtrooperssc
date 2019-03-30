<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IniciarSesion extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'INICIAR_SESION';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'USUARIO_ID');
    }
}
