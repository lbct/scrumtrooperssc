<?php

use Illuminate\Database\Seeder;
use App\Models\AsignaRol;

class AsignaRolSeeder extends Seeder
{
    public function run()
    {
        //Administrador
        AsignaRol::create([
        	'usuario_id' 		=>	1,
            'rol_id' 		    =>	1,
        ]);
        
        //Docentes
        AsignaRol::create([
        	'usuario_id' 		=>	2,
            'rol_id' 		    =>	2,
        ]);
        
        AsignaRol::create([
        	'usuario_id' 		=>	3,
            'rol_id' 		    =>	2,
        ]);
        
        AsignaRol::create([
        	'usuario_id' 		=>	4,
            'rol_id' 		    =>	2,
        ]);
        
        //Auxiliar Laboratorio
            //Como Estudiante
            AsignaRol::create([
                'usuario_id' 		=>	5,
                'rol_id' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'usuario_id' 		=>	5,
                'rol_id' 		    =>	3,
            ]);
            
            //Como Estudiante
            AsignaRol::create([
                'usuario_id' 		=>	6,
                'rol_id' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'usuario_id' 		=>	6,
                'rol_id' 		    =>	3,
            ]);
        
            //Como Estudiante
            AsignaRol::create([
                'usuario_id' 		=>	7,
                'rol_id' 		    =>	5,
            ]);

            //Como Auxiliar de Laboratorio
            AsignaRol::create([
                'usuario_id' 		=>	7,
                'rol_id' 		    =>	3,
            ]);
        
        // Auxiliar Terminal
            //Como Auxiliar de Terminal
            AsignaRol::create([
                'usuario_id' 		=>	8,
                'rol_id' 		    =>	4,
            ]);
        
        //Estudiantes
        AsignaRol::create([
            'usuario_id' 		=>	9,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	10,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	11,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	12,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	13,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	14,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	15,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	16,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	17,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	18,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	19,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	20,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	21,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	22,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	23,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	24,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	25,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	26,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	27,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	28,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	29,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	30,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	31,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	32,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	33,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	34,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	35,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	36,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	37,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	38,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	39,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	40,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	41,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	42,
            'rol_id' 		    =>	5,
        ]);
        AsignaRol::create([
            'usuario_id' 		=>	43,
            'rol_id' 		    =>	5,
        ]);
    }
}
