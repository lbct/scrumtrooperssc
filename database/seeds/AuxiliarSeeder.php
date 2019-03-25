<?php

use Illuminate\Database\Seeder;
use App\Auxiliar;

class AuxiliarSeeder extends Seeder
{
    public function run()
    {
        Auxiliar::create([
        	'USUARIO_ID' 		=>	'3',
        ]);
    }
}
