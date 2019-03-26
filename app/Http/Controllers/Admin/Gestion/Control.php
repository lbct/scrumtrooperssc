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
                'numero_semestre'                => 'required',
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
                $numero_semestre = 1;
                switch($request->numero_semestre)
                {
                    case 'PS': $numero_semestre = 1; break;
                    case 'VER': $numero_semestre = 2; break;
                    case 'SS': $numero_semestre = 3; break;
                    case 'INV': $numero_semestre = 4; break;
                }
                $gestion->FECHA_INICIO      = $request->fecha_inicio;
                $gestion->FECHA_FIN         = $request->fecha_fin;
                $gestion->NUMERO_SEMESTRE   = $numero_semestre;

                $gestion->save();
                $request->session()->flash('alert-success', 'Gestión creada con éxito');
                return redirect('/administrador');
            }
        }
        
        return redirect('/login');
    }
}