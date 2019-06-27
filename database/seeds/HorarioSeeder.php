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
        
        Horario::create([
        'HORA_INICIO' 		        =>	'11:15:00',
        'HORA_FIN' 	                =>	'12:45:00',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'12:45:00',
        'HORA_FIN' 	                =>	'14:15:00',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'14:15:00',
        'HORA_FIN' 	                =>	'15:45:00',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'15:45:00',
        'HORA_FIN' 	                =>	'17:15:00',
        ]);
    }
}
