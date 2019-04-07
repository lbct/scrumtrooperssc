<?php
namespace App\Http\Controllers\Estudiante\Inicio;

use App\Models\Usuario;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Estudiante\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getInicio(Request $request)
    {
        if( $this->rol->is($request) )
            return view('estudiante.index');
        return redirect('login');
    }
}