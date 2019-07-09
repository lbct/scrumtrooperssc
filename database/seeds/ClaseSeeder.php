<?php

use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClaseSeeder extends Seeder
{
    public function run()
    {
         Clase::create([
        	'GESTION_ID' 		    =>	1,
        	'AULA_ID'		        =>	1,
        	'HORARIO_ID'			=>	7,
            'GRUPO_A_DOCENTE_ID'    =>	1,
            'DIA'			        =>	2,
            'SEMANA_ACTUAL_SESION'	=>	0,
        ]);
        
        Clase::create([
        	'GESTION_ID' 		    =>	1,
        	'AULA_ID'		        =>	1,
        	'HORARIO_ID'			=>	7,
            'GRUPO_A_DOCENTE_ID'    =>	2,
            'DIA'			        =>	2,
            'SEMANA_ACTUAL_SESION'	=>	0,
        ]);
        
        Clase::create([
        	'GESTION_ID' 		    =>	1,
        	'AULA_ID'		        =>	1,
        	'HORARIO_ID'			=>	7,
            'GRUPO_A_DOCENTE_ID'    =>	3,
            'DIA'			        =>	2,
            'SEMANA_ACTUAL_SESION'	=>	0,
        ]);
    }
}
