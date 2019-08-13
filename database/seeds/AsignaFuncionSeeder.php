<?php

use Illuminate\Database\Seeder;
use App\Models\AsignaFuncion;
use App\Models\Funcion;

class AsignaFuncionSeeder extends Seeder
{
    public function run()
    {
        AsignaFuncion::create([
            'rol_id' 		    =>	1,
            'funcion_id' 	    =>	1,
        ]);
    }
}
