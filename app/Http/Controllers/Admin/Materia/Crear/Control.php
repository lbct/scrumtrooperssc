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
                ->with('items', $items)
                ->with('id_gestion', $id_gestion)
                ->with('gestiones', $gestiones);
        }

        return redirect('/login');
    }

    //Crea una nueva Materia
    public function postRegistro(Request $request)
    {
        $gestion = $request->gestion;
        if ($this->rol->is($request)) {
            $validator = Validator::make($request->all(), [
                'nombre_materia'    => 'required',
                'codigo_materia'    => 'required',
            ]);
            $materiaA = Materia::where('CODIGO_MATERIA', $request->codigo_materia)->count();
            $materiaB = Materia::where('NOMBRE_MATERIA', $request->nombre_materia)->count();
            //return $materiaA;

            if ($validator->fails()) {
                return redirect('/administrador/crearMateria')->withErrors($validator)->withInput();
            }else {
                $request->session()->flash('alert-danger', 'Ya existe la Materia.');
                return view('docente.index')->withErrors($validator)->withInput();
            }
            if ($materiaA == 0 && $materiaB == 0) {
                $materia = new Materia();
                $materia->CODIGO_MATERIA    = $request->codigo_materia;
                $materia->NOMBRE_MATERIA    = $request->nombre_materia;
                $materia->GESTION_ID        = $request->gestion_id;
                $materia->save();
                $request->session()->flash('alert-success', 'Materia creada con exito');
            } 
        }
        return redirect('/login');
    }
}
