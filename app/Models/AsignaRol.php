<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignaRol extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'ASIGNA_ROL';
    
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'USUARIO_ID');
    }
    
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'ROL_ID');
    }
}
