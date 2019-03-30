<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroGrupoDocenteGestion extends Migration
{
    public function up()
    {
        Schema::create('REGISTRO_GRUPO_DOCENTE_GESTION', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('GESTION_ID')->unsigned();
            $table->integer('GRUPO_DOCENTE_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('GESTION_ID')->references('ID')->on('GESTION')->onDelete('cascade');
            $table->foreign('GRUPO_DOCENTE_ID')->references('ID')->on('GRUPO_DOCENTE')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('REGISTRO_GRUPO_DOCENTE_GESTION');
    }
}
