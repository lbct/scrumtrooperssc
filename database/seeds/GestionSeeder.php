<?php

use Illuminate\Database\Seeder;
use App\Models\Gestion;

class GestionSeeder extends Seeder
{
    public function run()
    {
        Gestion::create([
        	'PERIODO_ID' 		=>	1,
            'ANO_GESTION' 		=>	'2019',
        ]);
    }
}
