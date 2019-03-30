<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaRol extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ASIGNA_ROL';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'USUARIO_ID');
    }
    
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol', 'ROL_ID');
    }
}
