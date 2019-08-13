<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFechaInscripcion extends Migration
{
    public function up()
    {
        Schema::create('fecha_inscripcion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->dateTime('inicio_inscripcion');
            $table->dateTime('fin_inscripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('fecha_inscripcion');
    }
}
