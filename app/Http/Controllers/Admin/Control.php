<?php
<<<<<<< HEAD

=======
>>>>>>> master
namespace App\Http\Controllers\Admin;

use App\Usuario;
use App\AsignaRol;
<<<<<<< HEAD
use App\Admin;
use App\Http\Controllers\Controller;
=======
use App\Estudiante;
use App\Classes\Rol;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
>>>>>>> master
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

<<<<<<< HEAD
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

=======
class Control extends Base
{
    public function getVista(Request $request)
    {
        if( $this->rol->is($request) )
            return view('admin.index');
        
        return redirect('login');
    }
    
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return 'GET Crear cuenta Administrador';
        }
        
        return redirect('login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request)  )
        {
            return 'POST Crear cuenta Administrador';
        }
        
        return redirect('login');
    }
>>>>>>> master
}