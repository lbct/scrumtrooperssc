<?php
namespace App\Http\Controllers\Admin\Docente\Crear;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Docente;
use App\Models\GrupoADocente;
use App\Models\GrupoDocente;
use App\Models\Materia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Control extends Base
{
    //Obtiene la vista de registro para nuevo Docente
    public function getRegistro(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return view('admin.docente.crear');
        }
        return redirect('login');
    }
    
    //Guarda los datos del registro del nuevo Administrador
    public function postRegistro(Request $request)
    {
        if( $this->rol->is($request))
        {
            $validator = Validator::make($request->all(), [
                'username'                  => 'required|min:2',
                'password'                  => 'required|min:2',
                'password_confirmation'     => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
            ]);
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if($validator->fails())
                    return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
                else
                {
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                    return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
                }
            }
            else
            {
                $cuentaCreada = Usuario::where('USERNAME',($request->username))->get();
            
                if($cuentaCreada->isEmpty())
                {
                    //Creación de usuario
                    $usuario = new Usuario();

                    $usuario->USERNAME          = $request->username;
                    $usuario->PASSWORD          = Hash::make($request->password);
                    $usuario->NOMBRE            = $request->nombre;
                    $usuario->APELLIDO          = $request->apellido;
                    $usuario->CORREO            = $request->correo;

                    $usuario->save();

                    //Añadir rol de estudiante al usuario
                    $rolAsignado = new AsignaRol;

                    $rolAsignado->ROL_ID        = 2;
                    $rolAsignado->USUARIO_ID    = $usuario->ID;

                    $rolAsignado->save();

                    //Crear estudiante
                    $docente = new Docente;

                    $docente->USUARIO_ID = $usuario->ID;

                    $docente->save();
                    
                    $request->session()->flash('alert-success', 'Cuenta Creada');
                    return redirect('administrador');
                }
                
                $request->session()->flash('alert-danger', 'Usuario no válido');
                return redirect('administrador/crearDocente')->withErrors($validator)->withInput();
            }
        }
        return redirect('login');
    }

    public function getGrupoDocentesForm(Request $request){
        if( $this->rol->is($request))
        {
            $materias = Materia::select('ID', 'CODIGO_MATERIA', 'NOMBRE_MATERIA')
                                ->get();
            $docentes = Docente::join('USUARIO','USUARIO.ID','=','USUARIO_ID')
                                ->select('DOCENTE.ID', 'NOMBRE', 'APELLIDO')
                                ->get();
            return view('admin.docente.ver.grupoform')
                    ->with('materias', $materias)
                    ->with('docentes', $docentes);
        }
        return view('login');
    }

    public function postGrupoDocentesForm(Request $request){
        if( $this->rol->is($request))
        {
            $consulta = GrupoADocente::where('DOCENTE_ID', '=', $request->docente)
                                    ->join('GRUPO_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_DOCENTE_ID')
                                    ->where('MATERIA_ID', '=', $request->materia)
                                    ->first();
            if (isset($consulta))
            {
                $request->session()->flash('alert-danger', 'El Docente Seleccionado ya pertenece a un Grupo Docente para la Materia');
                return redirect('/administrador/crearGrupoDocentes');
            }
            else
            {
                $materia = Materia::where('MATERIA.ID', '=', $request->materia)->first();
                $grupoDocente = new GrupoDocente();
                $grupoDocente->MATERIA_ID = $request->materia;
                $grupoDocente->DETALLE_GRUPO_DOCENTE = $materia->NOMBRE_MATERIA;  
                $grupoDocente->save();              

                
                $grupoADocente = new GrupoADocente();
                $grupoADocente->GRUPO_DOCENTE_ID    = $grupoDocente->ID;
                $grupoADocente->DOCENTE_ID   = $request->docente;
                $grupoADocente->save();
                $request->session()->flash('alert-success', 'Grupo Docente creado con éxito');
                return redirect('administrador/verGruposDocentes');
            }
        }
        return view('login');
    }
}