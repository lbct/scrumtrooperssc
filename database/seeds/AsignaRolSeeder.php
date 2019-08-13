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
        AsignaRol::create([
            'usuario_id' 		=>	5,
            'rol_id' 		    =>	3,
        ]);

        AsignaRol::create([
            'usuario_id' 		=>	6,
            'rol_id' 		    =>	3,
        ]);

        AsignaRol::create([
            'usuario_id' 		=>	7,
            'rol_id' 		    =>	3,
        ]);
        
        // Auxiliar Terminal
        AsignaRol::create([
            'usuario_id' 		=>	8,
            'rol_id' 		    =>	4,
        ]);
        
        //Estudiantes
        include 'poblacion/AsignaRolSeeder.php';
    }
}
