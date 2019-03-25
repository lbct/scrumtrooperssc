<?php
namespace App\Http\Controllers\Admin\Gestion;

use App\Gestion;
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
                'numero_semestre'                => 'required|min:1|max:1',
                'fecha_inicio'          => 'required',
                'fecha_fin'          => 'required',
            ]);
            
            if($validator->fails() || $request->contrasena != $request->confirmacion_contrasena) {
                return redirect('/administrador/crearGestion')->withErrors($validator)->withInput();
            }
            else
            {
                //Creación de usuario
                $gestion = new Gestion();
                
                $gestion->FECHA_INICIO      = $request->fecha_inicio;
                $gestion->FECHA_FIN         = $request->fecha_fin;
                $gestion->NUMERO_SEMESTRE   = $request->numero_semestre;

                $gestion->save();
                return redirect('/administrador');
            }
        }
        
        return redirect('/login');
    }
}