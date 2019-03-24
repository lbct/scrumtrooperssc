<?php

namespace App\Http\Controllers\Admin\Docente;

use App\Usuario;
use App\AsignaRol;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Controller
{
    public function editCuenta()
    {
        return view('admin/editarDocente');
    }

    public function postEdit()
    {
        return view('welcome');
    }

}