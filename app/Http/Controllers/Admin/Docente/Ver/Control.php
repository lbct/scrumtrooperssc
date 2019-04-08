<?php
namespace App\Http\Controllers\Admin\Docente\Ver;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Docente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Control extends Base
{
    //Obtiene la vista de la lista de Docentes
    public function getLista(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $docentes = Docente::all();
            $usuarios = [];
            foreach($docentes as $docente)
            {
                array_push($usuarios, $docente -> usuario);
            }
            return view('admin.docente.ver.lista')->with('usuarios', $usuarios);
        }
        return redirect('login');
    }

    //Obtiene la vista para ver los datos del Docente seleccionado
    public function getUsuario(Request $request, $id_usuario)
    {
        if( $this->rol->is($request))
        {
            $usuario = Usuario::find($id_usuario);
            return view('admin.docente.ver.usuario')->with('usuario', $usuario);
        }
        return redirect('login');
    }
}