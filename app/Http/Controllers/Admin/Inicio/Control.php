<?php
namespace App\Http\Controllers\Admin\Inicio;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Administrador;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getInicio(Request $request)
    {
        if( $this->rol->is($request) )
            return view('admin.index');
        
        return redirect('login');
    }
}