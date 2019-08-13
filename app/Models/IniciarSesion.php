<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IniciarSesion extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'iniciar_sesion';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
}
