<?php
namespace App\Http\Controllers\Administrador\Usuarios;

use App\Models\Usuario;
use App\Models\Materia;
use App\Models\AsignaRol;
use App\Models\Gestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Administrador\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class Administrador extends Base
{
    public function todos(Request $request){
        $administradores = AsignaRol::where('rol_id', 1)
                           ->join('usuario', 'usuario.id', '=', 'asigna_rol.usuario_id')
                           ->select('usuario_id', 'nombre', 'apellido', 'correo', 'username')
                           ->get();
        
        return $administradores;
    }
}