<?php

namespace App\Http\Controllers\Admin;

use App\Usuario;
use App\AsignaRol;
use App\Admin;
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
        return view('admin.vistaInicial');
    }

}