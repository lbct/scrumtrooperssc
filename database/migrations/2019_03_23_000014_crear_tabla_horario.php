<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaHorario extends Migration
{
    public function up()
    {
        Schema::create('HORARIO', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->time('HORA_INICIO');
            $table->time('HORA_FIN');
            $table->string('DETALLE_HORARIO',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('HORARIO');
    }
}
