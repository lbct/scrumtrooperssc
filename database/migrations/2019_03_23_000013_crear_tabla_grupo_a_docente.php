<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGrupoADocente extends Migration
{
    public function up()
    {
        Schema::create('grupo_a_docente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('docente_id')->unsigned();
            $table->integer('grupo_docente_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('docente_id')->references('id')->on('docente')->onDelete('cascade');
            $table->foreign('grupo_docente_id')->references('id')->on('grupo_docente')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('grupo_a_docente');
    }
}
