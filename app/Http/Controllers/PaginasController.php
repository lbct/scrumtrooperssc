<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class PaginasController extends Controller
{
   
    public function administrador()
    {
        return view('administrador');
    }

    public function estudiante()
    {
        return view('estudiante');
    }
}