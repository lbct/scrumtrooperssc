<?php
namespace App\Http\Controllers\Admin\Gestion;

use App\Models\Gestion;
use App\Models\Periodo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Control extends Base
{
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $items = Periodo::all();
            return view('admin.gestion.crear')->with('items', $items);
        }
        
        return redirect('/login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'periodo'    => 'required',
                'anio_gestion'       => 'required',
            ]);
            
            if($validator->fails()) 
            {
                return redirect('/administrador/crearGestion')->withErrors($validator)->withInput();
            }
            else
            {
                try{
                    $gestion = Gestion::whereRaw('PERIODO_ID='.($request->periodo).' and ANO_GESTION='.($request->anio_gestion))->firstOrFail();
                    $request->session()->flash('alert-danger', 'Ya existe la gestión.');
                    return redirect('/administrador/crearGestion');
                }
                catch(ModelNotFoundException $e) 
                {
                    $gestion = new Gestion();
                    $gestion->PERIODO_ID    = $request->periodo;
                    $gestion->ANO_GESTION   = $request->anio_gestion;
                    $gestion->save();
                    $request->session()->flash('alert-success', 'Gestión creada con éxito');
                    return redirect('/administrador');
                }
            }
        }
        
        return redirect('/login');
    }
}