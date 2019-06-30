<?php

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    public function run()
    {
        Periodo::create([
            'descripcion' 		=>	'Primer Semestre',
        ]);
        
        Periodo::create([
            'descripcion' 		=>	'Segundo Semestre',
        ]);
        
        Periodo::create([
            'descripcion' 		=>	'Invierno',
        ]);
        
        Periodo::create([
            'descripcion' 		=>	'Verano',
        ]);
    }
}
