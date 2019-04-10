<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaPractica extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'GUIA_PRACTICA';
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'GUIA_PRACTICA_ID', 'ID');
    }
}
