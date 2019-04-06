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
                'FECHA'             =>	'2019-03-23',
            ]);
        }
        
        //Docente
        //Añadir Auxiliar
        AsignaFuncion::create([
            'ROL_ID' 		    =>	2,
            'FUNCION_ID' 	    =>	10,
            'FECHA'             =>	'2019-03-23',
        ]);
        
        //Editar Auxiliar
        AsignaFuncion::create([
            'ROL_ID' 		    =>	2,
            'FUNCION_ID' 	    =>	11,
            'FECHA'             =>	'2019-03-23',
        ]);
        
        //Borrar Auxiliar
        AsignaFuncion::create([
            'ROL_ID' 		    =>	2,
            'FUNCION_ID' 	    =>	12,
            'FECHA'             =>	'2019-03-23',
        ]);
        
        //Auxiliar
        
        
        //Estudiante
        
    }
}
