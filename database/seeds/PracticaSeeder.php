<?php

use Illuminate\Database\Seeder;
use App\Models\Practica;

class PracticaSeeder extends Seeder
{
    public function run()
    {
        Practica::create([
        'SESION_ID' 		                 =>	1,
        'GUIA_PRACTICA' 	                 =>	'practica01.pdf',
        'DETALLE_PRACTICA' 	                 =>	'Primera práctica. Subir un archivo .zip',
        ]);
         
        Practica::create([
        'SESION_ID' 		                 =>	1,
        'GUIA_PRACTICA' 	                 =>	'practica02.pdf',
        'DETALLE_PRACTICA' 	                 =>	'Segunda Práctica. Subir un archivo .zip',
        ]);
        
        Practica::create([
        'SESION_ID' 		                 =>	2,
        'GUIA_PRACTICA' 	                 =>	'practica01.pdf',
        'DETALLE_PRACTICA' 	                 =>	'Primera práctica. Subir un archivo .zip',
        ]);
    }
}
