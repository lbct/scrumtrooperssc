<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroAsistenciaPracticaEstudiante extends Migration
{
    public function up()
    {
        Schema::create('REGISTRO_ASISTENCIA_PRACTICA_ESTUDIANTE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('PRACTICA_ID')->unsigned();
            $table->integer('ESTUDIANTE_ID')->unsigned();
            
            $table->boolean('ASISTENCIA');
            $table->timestamps();
            
            $table->foreign('PRACTICA_ID')->references('ID')->on('PRACTICA')->onDelete('cascade');
            $table->foreign('ESTUDIANTE_ID')->references('ID')->on('ESTUDIANTE')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('REGISTRO_ASISTENCIA_PRACTICA_ESTUDIANTE');
    }
}
