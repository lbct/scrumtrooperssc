<?php

namespace App\Http\Controllers\Estudiante\Subir;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Estudiante\Base;

class Control extends Base
{
    public function getSubir(Request $request)
    {
       return view('estudiante.subir.portafolio');
    }
}
