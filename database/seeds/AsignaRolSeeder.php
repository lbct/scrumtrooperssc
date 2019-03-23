<?php

use Illuminate\Database\Seeder;
use App\AsignaRol;

class AsignaRolSeeder extends Seeder
{
    public function run()
    {
        //Administrador
        AsignaRol::create([
        	'USUARIO_ID' 		=>	1,
            'ROL_ID' 		    =>	1,
        ]);
        
        //Docente
        AsignaRol::create([
        	'USUARIO_ID' 		=>	2,
            'ROL_ID' 		    =>	2,
        ]);
        
        //Auxiliar
        AsignaRol::create([
        	'USUARIO_ID' 		=>	3,
            'ROL_ID' 		    =>	3,
        ]);
        
        //Estudiante
        AsignaRol::create([
        	'USUARIO_ID' 		=>	4,
            'ROL_ID' 		    =>	4,
        ]);
    }
}
