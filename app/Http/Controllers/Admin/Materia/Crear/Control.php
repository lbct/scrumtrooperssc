<?php
namespace App\Http\Controllers\Admin\Materia\Crear;

use App\Models\Gestion;
use App\Models\Periodo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Materia;

class Control extends Base
{
    //Obtiene la vista para crea una nueva Materia
    public function getRegistro(Request $request)
    {
        if ($this->rol->is($request)) {
            $items = Gestion::all();
            $id_gestion = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->first()->ID;
            $gestiones = Gestion::select()->orderByRaw('ANO_GESTION desc, ID desc')->get();
            return view('admin.materia.crear')
                ->with('id_gestion', $id_gestion)
                ->with('gestiones', $gestiones);
        }

        return redirect('/login');
    }

    //Crea una nueva Materia
    public function postRegistro(Request $request)
    {
        $gestion_id = $request->gestion_id;
        if ($this->rol->is($request)) {
            $validator = Validator::make($request->all(), [
                'nombre_materia'    => 'required',
                'codigo_materia'    => 'required|unique:materia',
                'detalle_materia'   => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/administrador/crearMateria')->withErrors($validator)->withInput();
            } else {
                $materia = Materia::whereRaw('CODIGO_MATERIA=\'' . ($request->codigo_materia) . '\' and NOMBRE_MATERIA=\'' . ($request->nombre_materia) . '\'')->first();
                if ($materia != null ) {
                    $request->session()->flash('alert-danger', 'Ya existe la Materia.');
                    return redirect('/administrador/crearMateria');
                } else {
                    $materia = new Materia();
                    $materia->CODIGO_MATERIA    = $request->codigo_materia;
                    $materia->NOMBRE_MATERIA    = $request->nombre_materia;
                    $materia->DETALLE_MATERIA   = $request->detalle_materia;
                    $materia->GESTION_ID        = $request->gestion_id;
                    $materia->save();
                    $request->session()->flash('alert-success', 'Materia creada con exito');
                    return redirect('/administrador/crearMateria')->withInput();
                }
            }
        }
        return redirect('/login');
    }
}
