<?php

use Illuminate\Database\Seeder;
use App\Models\EnvioPractica;

class EnvioPracticaSeeder extends Seeder
{
    public function run()
    {
        EnvioPractica::create([
        'SESION_ESTUDIANTE_ID' 		         =>	1,
        'EN_LABORATORIO' 	                 =>	true,
        'ARCHIVO'                            => 'CesarQuiroga01.zip',
        ]);
         
        EnvioPractica::create([
        'SESION_ESTUDIANTE_ID' 		         =>	1,
        'EN_LABORATORIO' 	                 =>	false,
        'ARCHIVO'                            => 'CesarQuiroga02.zip',
        ]);
    }
}
