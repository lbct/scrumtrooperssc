<?php

use Illuminate\Database\Seeder;
use App\Models\Sesion;

class SesionSeeder extends Seeder
{
    public function run()
    {
        Sesion::create([
        	'clase_id' 		        =>	1,
        	'auxiliar_terminal_id'  =>	null,
        	'guia_practica_id'	    =>	1,
            'semana'			    =>	1,
        ]);
        
        Sesion::create([
        	'clase_id' 		        =>	1,
        	'auxiliar_terminal_id'  =>	null,
        	'guia_practica_id'	    =>	1,
            'semana'			    =>	2,
        ]);
    }
}
