<?php

use Illuminate\Database\Seeder;
use App\Models\Auxiliar;

class AuxiliarSeeder extends Seeder
{
    public function run()
    {
        //ID = 1
        Auxiliar::create([
        	'USUARIO_ID' 		=>	4,
        ]);
        
        //ID = 2
        Auxiliar::create([
        	'USUARIO_ID' 		=>	5,
        ]);
        
        //ID = 3
        Auxiliar::create([
        	'USUARIO_ID' 		=>	6,
        ]);
        
        //ID = 4
        Auxiliar::create([
        	'USUARIO_ID' 		=>	8,
        ]);
    }
}
