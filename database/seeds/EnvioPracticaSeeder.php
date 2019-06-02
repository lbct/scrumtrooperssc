<?php

use Illuminate\Database\Seeder;
use App\Models\EnvioPractica;

class EnvioPracticaSeeder extends Seeder
{
    public function run()
    {
        //CesarQuiroga - Semana 1
        EnvioPractica::create([
            'SESION_ESTUDIANTE_ID' 		         =>	1,
            'EN_LABORATORIO' 	                 =>	true,
            'ARCHIVO'                            => 'CesarQuiroga01.zip',
        ]);
         
        //CesarQuiroga - Semana 2
        EnvioPractica::create([
            'SESION_ESTUDIANTE_ID' 		         =>	2,
            'EN_LABORATORIO' 	                 =>	false,
            'ARCHIVO'                            => 'CesarQuiroga02.zip',
        ]);
        
        //AlexCardona - Semana 1
        EnvioPractica::create([
            'SESION_ESTUDIANTE_ID' 		         =>	3,
            'EN_LABORATORIO' 	                 =>	true,
            'ARCHIVO'                            => 'AlexCardona01.zip',
        ]);
         
        EnvioPractica::create([
            'SESION_ESTUDIANTE_ID' 		         =>	3,
            'EN_LABORATORIO' 	                 =>	false,
            'ARCHIVO'                            => 'AlexCardona02.zip',
        ]);
    }
}
