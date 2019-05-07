<?php

use Illuminate\Database\Seeder;
use App\Models\Sesion;

class SesionSeeder extends Seeder
{
    public function run()
    {
        //Clase 1 - Introducción a la programación
        Sesion::create([
            'CLASE_ID' 		                     =>	1,
            'AUXILIAR_ID' 		                 =>	2,
            'GUIA_PRACTICA_ID' 	                 =>	1,
            'SEMANA' 	                         =>	1,
        ]);
        
        Sesion::create([
            'CLASE_ID' 		                     =>	1,
            'AUXILIAR_ID' 		                 =>	2,
            'GUIA_PRACTICA_ID' 	                 =>	2,
            'SEMANA' 	                         =>	2,
        ]);
        
        Sesion::create([
            'CLASE_ID' 		                     =>	1,
            'AUXILIAR_ID' 		                 =>	NULL,
            'GUIA_PRACTICA_ID' 	                 =>	2,
            'SEMANA' 	                         =>	3,
        ]);
        
        //Clase 2 - Introducción a la programación
        Sesion::create([
            'CLASE_ID' 		                     =>	2,
            'AUXILIAR_ID' 		                 =>	2,
            'GUIA_PRACTICA_ID' 	                 =>	1,
            'SEMANA' 	                         =>	1,
        ]);
        
        Sesion::create([
            'CLASE_ID' 		                     =>	2,
            'AUXILIAR_ID' 		                 =>	2,
            'GUIA_PRACTICA_ID' 	                 =>	2,
            'SEMANA' 	                         =>	2,
        ]);
        
        Sesion::create([
            'CLASE_ID' 		                     =>	2,
            'AUXILIAR_ID' 		                 =>	2,
            'GUIA_PRACTICA_ID' 	                 =>	2,
            'SEMANA' 	                         =>	3,
        ]);
        
        //Clase 3 - Introducción a la programación
        Sesion::create([
            'CLASE_ID' 		                     =>	3,
            'AUXILIAR_ID' 		                 =>	1,
            'GUIA_PRACTICA_ID' 	                 =>	2,
            'SEMANA' 	                         =>	1,
        ]);
        
        Sesion::create([
            'CLASE_ID' 		                     =>	3,
            'AUXILIAR_ID' 		                 =>	2,
            'GUIA_PRACTICA_ID' 	                 =>	2,
            'SEMANA' 	                         =>	2,
        ]);
    }
}
