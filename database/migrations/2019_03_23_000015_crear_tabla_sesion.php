<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSesion extends Migration
{
    public function up()
    {
        Schema::create('SESION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('AULA_ID')->unsigned();
            $table->integer('HORARIO_ID')->unsigned();
            $table->integer('AUXILIAR_ID')->unsigned();
            $table->integer('ASIGNAR_GRUPO_A_DOCENTE_ID')->unsigned();
            
            $table->string('DETALLE_SESION',255);
            $table->timestamps();
            
            $table->foreign('AULA_ID')->references('ID')->on('AULA')->onDelete('cascade');
            $table->foreign('HORARIO_ID')->references('ID')->on('HORARIO')->onDelete('cascade');
            $table->foreign('AUXILIAR_ID')->references('ID')->on('AUXILIAR')->onDelete('cascade');
            $table->foreign('ASIGNAR_GRUPO_A_DOCENTE_ID')->references('ID')->on('ASIGNAR_GRUPO_A_DOCENTE')->onDelete('cascade');
            
            $table->unique(['AULA_ID', 'HORARIO_ID']);
            $table->unique(['HORARIO_ID', 'AUXILIAR_ID']);
        });
    }

    public function down()
    {
        Schema::drop('SESION');
    }
}
