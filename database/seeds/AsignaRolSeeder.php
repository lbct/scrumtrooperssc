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
        
        /*
            Docentes
        */
        AsignaRol::create([
        	'USUARIO_ID' 		=>	2,
            'ROL_ID' 		    =>	2,
        ]);
        
        AsignaRol::create([
        	'USUARIO_ID' 		=>	3,
            'ROL_ID' 		    =>	2,
        ]);
        
        /*
            Auxiliar Laboratorio
        */
            //Como Estudiante
            AsignaRol::create([
                'USUARIO_ID' 		=>	4,
                'ROL_ID' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'USUARIO_ID' 		=>	4,
                'ROL_ID' 		    =>	3,
            ]);
        
        /*
            Auxiliar Terminal
        */
            //Como Estudiante
            AsignaRol::create([
                'USUARIO_ID' 		=>	5,
                'ROL_ID' 		    =>	5,
            ]);

            //Como Auxiliar de Terminal
            AsignaRol::create([
                'USUARIO_ID' 		=>	5,
                'ROL_ID' 		    =>	4,
            ]);
        
        /*
            Estudiantes
        */
        AsignaRol::create([
        	'USUARIO_ID' 		=>	6,
            'ROL_ID' 		    =>	5,
        ]);
        
        AsignaRol::create([
        	'USUARIO_ID' 		=>	7,
            'ROL_ID' 		    =>	5,
        ]);
    }
}
