<?php

use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    public function run()
    {
        Horario::create([
        'HORA_INICIO' 		        =>	'06:45:00',
        'HORA_FIN' 	                =>	'08:15:00',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'08:15:00',
        'HORA_FIN' 	                =>	'09:45:00',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'09:45:00',
        'HORA_FIN' 	                =>	'11:15:00',
        ]);
    }
}
