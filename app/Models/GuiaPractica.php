<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuiaPractica extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'guia_practica';
    
    public function sesion()
    {
        return $this->hasMany('App\Models\Sesion', 'guia_practica_id', 'id');
    }
}
