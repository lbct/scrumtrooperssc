<?php

use Illuminate\Database\Seeder;
use App\Models\ResgistroGestionMateria;

class ResgistroGestionMateriaSeeder extends Seeder
{
    public function run()
    {
        ResgistroGestionMateria::create([
            'GESTION_ID' 		=>	1,
            'MATERIA_ID' 		=>	1,
        ]);
        
        ResgistroGestionMateria::create([
            'GESTION_ID' 		=>	1,
            'MATERIA_ID' 		=>	2,
        ]);
    }
}
