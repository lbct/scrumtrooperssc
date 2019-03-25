<?php

namespace App\Http\Controllers\Estudiante;

use App\Usuario;
use App\AsignaRol;
use App\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Controller
{
    public function getEdit()
    {
        return view('welcome');
    }

    public function postEdit()
    {
        return view('welcome');
    }

    public function getVista()
    {
        return view('welcome');
    }

}