<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSesionEstudiante extends Migration
{
    public function up()
    {
        Schema::create('sesion_estudiante', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('sesion_id')->unsigned();
            $table->integer('estudiante_clase_id')->unsigned();
            
            $table->string('comentario_auxiliar',1023)->nullable();
            $table->boolean('asistencia_sesion')->default(false);
            $table->timestamps();
            
            $table->foreign('sesion_id')->references('id')->on('sesion')->onDelete('cascade');
            $table->foreign('estudiante_clase_id')->references('id')->on('estudiante_clase')->onDelete('cascade');
            
            $table->unique(['sesion_id', 'estudiante_clase_id']);
        });
    }

    public function down()
    {
        Schema::drop('sesion_estudiante');
    }
}
