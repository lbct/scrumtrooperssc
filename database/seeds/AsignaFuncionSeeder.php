<?php

use Illuminate\Database\Seeder;
use App\Models\AsignaFuncion;
use App\Models\Funcion;

class AsignaFuncionSeeder extends Seeder
{
    public function run()
    {
        //Administrador
        $funciones = Funcion::all();
        foreach ($funciones as $funcion)
        {
            AsignaFuncion::create([
                'ROL_ID' 		    =>	1,
                'FUNCION_ID' 	    =>	$funcion->ID,
            ]);
        }
    }
}
