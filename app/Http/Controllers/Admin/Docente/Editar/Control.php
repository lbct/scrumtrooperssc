<?php
namespace App\Http\Controllers\Admin\Docente\Editar;

use App\Models\Usuario;
use App\Models\AsignaRol;
use App\Models\Docente;
use App\Models\GrupoDocente;
use App\Models\GrupoADocente;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Control extends Base
{
    //Obtiene la vista para editar la clave del Docente seleccionado
    public function getClave(Request $request, $id_usuario){
        if( $this->rol->is($request) )
        {
            return view('admin.docente.editar.clave')
            ->with('id_usuario', $id_usuario);
        }
        return redirect('login');
    }

    //Guarda la nueva clave del Docente seleccionado
    public function postClave(Request $request, $id_usuario){
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'password'                  => 'required|min:2',
                'password_confirmation'     => 'required|min:2',
            ]);
            if($validator->fails() || $request->password != $request->password_confirmation)
            {
                if($request->password != $request->password_confirmation)
                    $request->session()->flash('alert-danger', 'Las contraseñas no coinciden');
                return redirect('/administrador/editarDocente/'.$id_usuario.'/cambiarClave')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                $usuario = Usuario::find($id_usuario);
                $usuario->PASSWORD = Hash::make($request->password);
                $usuario->update();
                $request->session()->flash('alert-success', 'La contraseña se cambió correctamente.');
                return view('admin.docente.editar.usuario')
                ->with('usuario', $usuario);
            }
        }
        return redirect('login');
    }
    
    //Obtiene la vista para editar los datos del Docente seleccionado
    public function getUsuario(Request $request, $id_usuario)
    {
        if( $this->rol->is($request) )
        {
            $usuario = Usuario::find($id_usuario);
            return view('admin.docente.editar.usuario') -> with('usuario', $usuario);
        }
        
        return redirect('login');
    }
    
    //Guarda los datos modificados del Docente seleccionado
    public function postUsuario(Request $request, $id_usuario)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'username'                  => 'required|min:2',
                'nombre'                    => 'required|min:2',
                'apellido'                  => 'required|min:2',
                'correo'                    => 'required|min:8',
            ]);

            if($validator->fails() )
            {
                return redirect('administrador/editarDocente/'.$id_usuario)->withErrors($validator)->withInput();
            }
            else
            {
                $usuario_actual = Usuario::where('ID', $id_usuario)->first();
                $existeCuenta = Usuario::where('USERNAME',($request->username))->first() != null 
                && $usuario_actual->USERNAME != $request->username;
                if($existeCuenta){
                    $request->session()->flash('alert-danger', 'El nombre de usuario '.$request->username.' ya está siendo utilizado.');
                    return redirect('administrador/editarDocente/'.$id_usuario)->withErrors($validator)->withInput();
                }
                else{
                    $usuario_actual->USERNAME          = $request->username;
                    $usuario_actual->NOMBRE            = $request->nombre;
                    $usuario_actual->APELLIDO          = $request->apellido;
                    $usuario_actual->CORREO            = $request->correo;
                    $usuario_actual->update();
                    $request->session()->flash('alert-success', 'Datos del docente actualizados');
                    return redirect('administrador');
                }
            }
        }
        return redirect('login');
    }

    public function getDocentesGrupo(Request $request, $grupo_docente_id){
        if( $this->rol->is($request) )
        {
            $lista = GrupoADocente::where('GRUPO_DOCENTE_ID' , '=', $grupo_docente_id)
                    ->join('DOCENTE', 'DOCENTE.ID', '=', 'GRUPO_A_DOCENTE.DOCENTE_ID')
                    ->join('USUARIO', 'USUARIO.ID', '=', 'DOCENTE.USUARIO_ID')
                    ->select('DOCENTE_ID', 'NOMBRE', 'APELLIDO', 'GRUPO_DOCENTE_ID')
                    ->get();

            $docentes = Docente::join('USUARIO','USUARIO.ID','=','USUARIO_ID')
                            ->select('DOCENTE.ID', 'NOMBRE', 'APELLIDO')
                            ->get();

            $materia = GrupoDocente::where('GRUPO_DOCENTE.ID', '=', $grupo_docente_id)
                                    ->join('MATERIA', 'MATERIA.ID', '=', 'MATERIA_ID')
                                    ->select('MATERIA_ID', 'NOMBRE_MATERIA', 'CODIGO_MATERIA')
                                    ->first();
            return view('admin.docente.editar.grupos')
                    ->with('lista', $lista)
                    ->with('docentes', $docentes)
                    ->with('grupo_id', $grupo_docente_id)
                    ->with('materia', $materia);
        }
        return redirect('login');
    }

    public function postDocentesGrupo(Request $request){
        $materia = GrupoDocente::where('ID', '=', $request->grupo_id)->first();
        $consulta = GrupoADocente::where('DOCENTE_ID', '=', $request->docente)
                                    ->join('GRUPO_DOCENTE', 'GRUPO_DOCENTE.ID', '=', 'GRUPO_DOCENTE_ID')
                                    ->where('MATERIA_ID', '=', $materia->MATERIA_ID)
                                    ->first();
            if (isset($consulta))
            {
                $request->session()->flash('alert-danger', 'El Docente Seleccionado ya pertenece a un Grupo para esta Materia');
                return redirect('/administrador/editarGrupoDocente/'.$request->grupo_id);
            }
            else
            {
                $grupoADocente = new GrupoADocente();
                $grupoADocente->GRUPO_DOCENTE_ID    = $request->grupo_id;
                $grupoADocente->DOCENTE_ID   = $request->docente;
                $grupoADocente->save();

                $request->session()->flash('alert-success', 'Docente añadido con éxito');
                return redirect('administrador/editarGrupoDocente/'.$request->grupo_id);    
            }
    }
}