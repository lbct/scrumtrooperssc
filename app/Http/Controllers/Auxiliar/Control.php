<?php
namespace App\Http\Controllers\Auxiliar;

use App\Models\Usuario;
use App\Models\Auxiliar;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auxiliar\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return view('auxiliar.index');
        return redirect('login');
    }
    
}