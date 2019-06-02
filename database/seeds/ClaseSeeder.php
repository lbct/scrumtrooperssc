<?php

use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClaseSeeder extends Seeder
{
    public function run()
    {
        //Leticia Blanco Introducción a la programación 6:45 - 8:15 LAB0001 2019 Primer Semestre
        Clase::create([
        'GESTION_ID'                     => 1,
        'AULA_ID' 		                 =>	1,
        'HORARIO_ID' 	                 =>	1,
        'GRUPO_A_DOCENTE_ID' 	         =>	1,
        'DETALLE_CLASE' 	             =>	'',
        'DIA' 	                         =>	1,
        'SEMANA_ACTUAL_SESION' 	         =>	2,
        ]);
        
        //Leticia Blanco Introducción a la programación 9:45 - 11:15 LAB0003 2019 Primer Semestre
        Clase::create([
        'GESTION_ID'                     => 1,
        'AULA_ID' 		                 =>	3,
        'HORARIO_ID' 	                 =>	3,
        'GRUPO_A_DOCENTE_ID' 	         =>	1,
        'DETALLE_CLASE' 	             =>	'',
        'DIA' 	                         =>	1,
        'SEMANA_ACTUAL_SESION' 	         =>	1,
        ]);
        
        //Rosemary Torrico Introducción a la programación 8:15 - 9:45 LAB0002 2019 Primer Semestre
        Clase::create([
        'GESTION_ID'                     => 1,
        'AULA_ID' 		                 =>	2,
        'HORARIO_ID' 	                 =>	2,
        'GRUPO_A_DOCENTE_ID' 	         =>	2,
        'DETALLE_CLASE' 	             =>	'',
        'DIA' 	                         =>	1,
        'SEMANA_ACTUAL_SESION' 	         =>	2,
        ]);
        
        //Leticia Blanco Elementos 8:15 - 9:45 LAB0001 2019 Primer Semestre
        Clase::create([
        'GESTION_ID'                     => 1,
        'AULA_ID' 		                 =>	1,
        'HORARIO_ID' 	                 =>	2,
        'GRUPO_A_DOCENTE_ID' 	         =>	3,
        'DETALLE_CLASE' 	             =>	'',
        'DIA' 	                         =>	5,
        'SEMANA_ACTUAL_SESION' 	         =>	0,
        ]);
    }
}
