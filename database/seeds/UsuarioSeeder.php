<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        //Administrador
        Usuario::create([
        	'CODIGO_SIS' 		=>	'200100001',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Vladimir',
            'APELLIDO'			=>	'Costas',
            'CORREO'			=>	'v.costas@umss.edu.bo',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'4666037',
            'CI'				=>	'6324583',
            'FECHA_NACIMIENTO'	=>	'1990-06-09',
        ]);
        
        //Docente
        Usuario::create([
        	'CODIGO_SIS' 		=>	'200200001',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Leticia',
            'APELLIDO'			=>	'Blanco',
            'CORREO'			=>	'leticia@memi.umss.edu.bo',
            'SEXO'				=>	'F',
            'TELEFONO'			=>	'4252439',
            'CI'				=>	'6936875',
            'FECHA_NACIMIENTO'	=>	'1990-01-01',
        ]);
        
        Usuario::create([
        	'CODIGO_SIS' 		=>	'200200002',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Rosemary',
            'APELLIDO'			=>	'Torrico',
            'CORREO'			=>	'rosemary@cs.umss.edu.bo',
            'SEXO'				=>	'F',
            'TELEFONO'			=>	'71778384',
            'CI'				=>	'3549875',
            'FECHA_NACIMIENTO'	=>	'1990-09-03',
        ]);
        
        //Auxiliar
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400991',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'William',
            'APELLIDO'			=>	'Velasquez',
            'CORREO'			=>	'william.velasquez.umss@gmail.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'79712058',
            'CI'				=>	'9381027',
            'FECHA_NACIMIENTO'	=>	'1995-10-05',
        ]);
        
        //Estudiante
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400043',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Cesar',
            'APELLIDO'			=>	'Quiroga',
            'CORREO'			=>	'cesar.a.quiroga.c@gmail.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'60753939',
            'CI'				=>	'8846218',
            'FECHA_NACIMIENTO'	=>	'1995-08-03',
        ]);
        
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400929',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Alex',
            'APELLIDO'			=>	'Cardona',
            'CORREO'			=>	'alex.cardona@gmail.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'60789692',
            'CI'				=>	'6497347',
            'FECHA_NACIMIENTO'	=>	'1996-04-06',
        ]);
    }
}
