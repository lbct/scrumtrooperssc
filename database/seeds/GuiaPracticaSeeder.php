<?php

use Illuminate\Database\Seeder;
use App\Models\GuiaPractica;

class GuiaPracticaSeeder extends Seeder
{
    public function run()
    {
        GuiaPractica::create([
        	'archivo' 		        =>	'guia_1.pdf',
        	'detalle'               =>	'',
        ]);
    }
}
