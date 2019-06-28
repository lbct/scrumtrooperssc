<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaRol extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'asigna_rol';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id');
    }
    
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol', 'rol_id');
    }
}
