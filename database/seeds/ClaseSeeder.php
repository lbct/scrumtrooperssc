<?php

use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClaseSeeder extends Seeder
{
    public function run()
    {
        Clase::create([
        	'gestion_id' 		    =>	1,
        	'aula_id'		        =>	1,
        	'horario_id'			=>	7,
            'grupo_docente_id'      =>	1,
            'dia'			        =>	2,
            'semana_actual_sesion'	=>	15,
        ]);
        
        Clase::create([
        	'gestion_id' 		    =>	1,
        	'aula_id'		        =>	1,
        	'horario_id'			=>	6,
            'grupo_docente_id'      =>	1,
            'dia'			        =>	5,
            'semana_actual_sesion'	=>	15,
        ]);
    }
}
