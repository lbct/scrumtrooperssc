<?php

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    public function run()
    {
        Periodo::create([
            'DESCRIPCION' 		=>	'Primer Semestre',
        ]);
        
        Periodo::create([
            'DESCRIPCION' 		=>	'Segundo Semestre',
        ]);
        
        Periodo::create([
            'DESCRIPCION' 		=>	'Invierno',
        ]);
        
        Periodo::create([
            'DESCRIPCION' 		=>	'Verano',
        ]);
    }
}
