<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400001',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Administrador',
            'APELLIDO'			=>	'1',
            'CORREO'			=>	'Administrador@tis.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'11111111',
            'CI'				=>	'8888888',
            'FECHA_NACIMIENTO'	=>	'0000-00-00',
        ]);
        
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400002',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Docente',
            'APELLIDO'			=>	'1',
            'CORREO'			=>	'Docente@tis.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'11111111',
            'CI'				=>	'8888888',
            'FECHA_NACIMIENTO'	=>	'0000-00-00',
        ]);
        
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400003',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Auxiliar',
            'APELLIDO'			=>	'1',
            'CORREO'			=>	'Auxiliar@gmail.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'11111111',
            'CI'				=>	'8888888',
            'FECHA_NACIMIENTO'	=>	'0000-00-00',
        ]);
        
        Usuario::create([
        	'CODIGO_SIS' 		=>	'201400004',
        	'CONTRASENA'		=>	Hash::make('textoplano'),
        	'NOMBRE'			=>	'Estudiante',
            'APELLIDO'			=>	'1',
            'CORREO'			=>	'Estudiante@gmail.com',
            'SEXO'				=>	'M',
            'TELEFONO'			=>	'11111111',
            'CI'				=>	'8888888',
            'FECHA_NACIMIENTO'	=>	'0000-00-00',
        ]);
    }
}
