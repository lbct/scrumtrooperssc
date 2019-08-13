<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGrupoDocenteAuxiliar extends Migration
{
    public function up()
    {
        Schema::create('grupo_docente_auxiliar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('grupo_docente_id')->unsigned();
            $table->integer('auxiliar_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('grupo_docente_id')->references('id')->on('grupo_docente')->onDelete('cascade');
            $table->foreign('auxiliar_id')->references('id')->on('auxiliar')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('grupo_docente_auxiliar');
    }
}
