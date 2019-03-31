<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroEstudianteGrupoDocente extends Migration
{
    public function up()
    {
        Schema::create('REGISTRO_ESTUDIANTE_GRUPO_DOCENTE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('SESION_ID')->unsigned();
            $table->integer('ESTUDIANTE_ID')->unsigned();
            $table->integer('GRUPO_DOCENTE_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('SESION_ID')->references('ID')->on('SESION')->onDelete('cascade');
            $table->foreign('ESTUDIANTE_ID')->references('ID')->on('ESTUDIANTE')->onDelete('cascade');
            $table->foreign('GRUPO_DOCENTE_ID')->references('ID')->on('GRUPO_DOCENTE')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('REGISTRO_ESTUDIANTE_GRUPO_DOCENTE');
    }
}
