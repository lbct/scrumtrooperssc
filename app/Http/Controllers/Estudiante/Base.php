<?php
namespace App\Http\Controllers\Estudiante;

use App\Classes\Rol;
use App\Http\Controllers\Controller;

class Base extends Controller
{
    protected $rol;
    
    public function __construct()
    {
        $this->rol = new Rol('estudiante');
    }
}