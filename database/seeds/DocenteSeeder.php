<?php

use Illuminate\Database\Seeder;
use App\Docente;

class DocenteSeeder extends Seeder
{
    public function run()
    {
        Docente::create([
        	'USUARIO_ID' 		=>	'2',
        ]);
    }
}
