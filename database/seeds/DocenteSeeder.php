<?php

use Illuminate\Database\Seeder;
use App\Models\Docente;

class DocenteSeeder extends Seeder
{
    public function run()
    {
        Docente::create([
        	'USUARIO_ID' 		=>	2,
        ]);
        
        Docente::create([
        	'USUARIO_ID' 		=>	3,
        ]);
    }
}
