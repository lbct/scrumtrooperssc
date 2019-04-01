<?php
namespace App\Http\Controllers\Estudiante;

use App\Models\Usuario;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Inscripcion extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return view('estudiante.inscripcion');
        return redirect('login');
    }

    public function postInscripcion(){
        return null;
    }

}