<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEnvioPractica extends Migration
{
    public function up()
    {
        Schema::create('ENVIO_PRACTICA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('SESION_ESTUDIANTE_ID')->unsigned();
            
            $table->boolean('EN_LABORATORIO');
            $table->string('ARCHIVO',255);
            $table->timestamps();
            
            $table->foreign('SESION_ESTUDIANTE_ID')->references('ID')->on('SESION_ESTUDIANTE')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('ENVIO_PRACTICA');
    }
}
