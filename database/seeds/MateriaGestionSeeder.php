<?php

use Illuminate\Database\Seeder;
use App\Models\MateriaGestion;

class MateriaGestionSeeder extends Seeder
{
    public function run()
    {
        MateriaGestion::create([
            'GESTION_ID' 		=>	1,
            'MATERIA_ID' 		=>	1,
        ]);
        
        MateriaGestion::create([
            'GESTION_ID' 		=>	1,
            'MATERIA_ID' 		=>	2,
        ]);
    }
}
