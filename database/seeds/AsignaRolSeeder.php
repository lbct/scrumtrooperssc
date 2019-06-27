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
        
        AsignaRol::create([
        	'USUARIO_ID' 		=>	4,
            'ROL_ID' 		    =>	2,
        ]);
        
        //Auxiliar Laboratorio
            //Como Estudiante
            AsignaRol::create([
                'USUARIO_ID' 		=>	5,
                'ROL_ID' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'USUARIO_ID' 		=>	5,
                'ROL_ID' 		    =>	3,
            ]);
            
            //Como Estudiante
            AsignaRol::create([
                'USUARIO_ID' 		=>	6,
                'ROL_ID' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'USUARIO_ID' 		=>	6,
                'ROL_ID' 		    =>	3,
            ]);
        
            //Como Estudiante
            AsignaRol::create([
                'USUARIO_ID' 		=>	7,
                'ROL_ID' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'USUARIO_ID' 		=>	7,
                'ROL_ID' 		    =>	3,
            ]);
        
        // Auxiliar Terminal
            //Como Auxiliar de Terminal
            AsignaRol::create([
                'USUARIO_ID' 		=>	8,
                'ROL_ID' 		    =>	4,
            ]);
        
        //Estudiantes
        AsignaRol::create([
            'USUARIO_ID' 		=>	9,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	10,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	11,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	12,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	13,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	14,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	15,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	16,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	17,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	18,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	19,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	20,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	21,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	22,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	23,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	24,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	25,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	26,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	27,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	28,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	29,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	30,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	31,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	32,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	33,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	34,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	35,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	36,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	37,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	38,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	39,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	40,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	41,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	42,
            'ROL_ID' 		    =>	5,
        ]);
        AsignaRol::create([
            'USUARIO_ID' 		=>	43,
            'ROL_ID' 		    =>	5,
        ]);
    }
}
