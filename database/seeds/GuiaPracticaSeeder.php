<?php

use Illuminate\Database\Seeder;
use App\Models\GuiaPractica;

class GuiaPracticaSeeder extends Seeder
{
    public function run()
    {
        //Sesion 1 - Introducción a la programación
        GuiaPractica::create([
            'ARCHIVO' 		                     =>	"practica1.pdf",
        ]);
        
        //Sesion 2 - Introducción a la programación
        GuiaPractica::create([
            'ARCHIVO' 		                     =>	"practica2.pdf",
        ]);
    }
}
