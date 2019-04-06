<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGrupoDocenteAuxiliar extends Migration
{
    public function up()
    {
        Schema::create('GRUPO_DOCENTE_AUXILIAR', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('GRUPO_DOCENTE_ID')->unsigned();
            $table->integer('AUXILIAR_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('GRUPO_DOCENTE_ID')->references('ID')->on('GRUPO_DOCENTE')->onDelete('cascade');
            $table->foreign('AUXILIAR_ID')->references('ID')->on('AUXILIAR')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('GRUPO_DOCENTE_AUXILIAR');
    }
}
