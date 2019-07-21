<?php

use Illuminate\Database\Seeder;
use App\Models\Gestion;

class GestionSeeder extends Seeder
{
    public function run()
    {
        Gestion::create([
        	'periodo_id' 		=>	1,
            'anho_gestion' 		=>	'2019',
            'activa'            =>  true,
        ]);
    }
}
