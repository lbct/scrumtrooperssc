<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ADMINISTRADOR';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
}
