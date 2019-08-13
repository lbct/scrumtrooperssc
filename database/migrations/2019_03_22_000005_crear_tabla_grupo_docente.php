<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGrupoDocente extends Migration
{
    public function up()
    {
        Schema::create('grupo_docente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('materia_id')->unsigned();
            
            $table->string('detalle_grupo_docente',255)->nullable();
            $table->timestamps();
            
            $table->foreign('materia_id')->references('id')->on('materia')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('grupo_docente');
    }
}
