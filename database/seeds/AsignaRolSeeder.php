<?php

use Illuminate\Database\Seeder;
use App\Models\AsignaRol;

class AsignaRolSeeder extends Seeder
{
    public function run()
    {
        //Administrador
        AsignaRol::create([
        	'USUARIO_ID' 		=>	1,
            'ROL_ID' 		    =>	1,
        ]);
        
        //Docentes
        AsignaRol::create([
        	'USUARIO_ID' 		=>	2,
            'ROL_ID' 		    =>	2,
        ]);
        
        AsignaRol::create([
        	'USUARIO_ID' 		=>	3,
            'ROL_ID' 		    =>	2,
        ]);
        
        //Auxiliar
        //Como estudiante
        AsignaRol::create([
        	'USUARIO_ID' 		=>	4,
            'ROL_ID' 		    =>	4,
        ]);
        
        //Como Auxiliar
        AsignaRol::create([
        	'USUARIO_ID' 		=>	4,
            'ROL_ID' 		    =>	3,
        ]);
        
        //Estudiante
        AsignaRol::create([
        	'USUARIO_ID' 		=>	5,
            'ROL_ID' 		    =>	4,
        ]);
        
        AsignaRol::create([
        	'USUARIO_ID' 		=>	6,
            'ROL_ID' 		    =>	4,
        ]);
    }
}
