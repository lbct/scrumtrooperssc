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
        'DETALLE_HORARIO' 	        =>	'De 6:45 a 8:15',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'08:15:00',
        'HORA_FIN' 	                =>	'09:45:00',
        'DETALLE_HORARIO' 	        =>	'De 8:15 a 9:45',
        ]);
        
        Horario::create([
        'HORA_INICIO' 		        =>	'09:45:00',
        'HORA_FIN' 	                =>	'11:15:00',
        'DETALLE_HORARIO' 	        =>	'De 9:45 a 11:15',
        ]);
    }
}
