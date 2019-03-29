<?php
namespace App\Http\Controllers\Admin\Gestion;

use App\Models\Gestion;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Control extends Base
{
    public function getCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            return view('gestion.crear');
        }
        
        return redirect('/login');
    }
    
    public function postCrear(Request $request)
    {
        if( $this->rol->is($request) )
        {
            $validator = Validator::make($request->all(), [
                'numero_semestre'    => 'required',
                'fecha_inicio'       => 'required',
                'fecha_fin'          => 'required',
            ]);
            
            if($validator->fails()) 
            {
                return redirect('/administrador/crearGestion')->withErrors($validator)->withInput();
            }
            else
            {
                //Creación de gestión
                $gestion = new Gestion();
                
                $gestion->FECHA_INICIO      = $request->fecha_inicio;
                $gestion->FECHA_FIN         = $request->fecha_fin;
                $gestion->NUMERO_SEMESTRE   = $request->$numero_semestre;

                $gestion->save();
                $request->session()->flash('alert-success', 'Gestión creada con éxito');
                return redirect('/administrador');
            }
        }
        
        return redirect('/login');
    }
}