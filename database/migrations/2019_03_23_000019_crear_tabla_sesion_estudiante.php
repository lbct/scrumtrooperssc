<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSesionEstudiante extends Migration
{
    public function up()
    {
        Schema::create('SESION_ESTUDIANTE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('SESION_ID')->unsigned();
            $table->integer('ESTUDIANTE_ID')->unsigned();
            
            $table->string('COMENTARIO_AUXILIAR',255);
            $table->boolean('ASISTENCIA_SESION');
            $table->timestamps();
            
            $table->foreign('SESION_ID')->references('ID')->on('SESION')->onDelete('cascade');
            $table->foreign('ESTUDIANTE_ID')->references('ID')->on('ESTUDIANTE')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('SESION_ESTUDIANTE');
    }
}
