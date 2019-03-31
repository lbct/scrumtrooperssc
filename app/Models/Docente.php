<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'DOCENTE';
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'USUARIO_ID');
    }
}
