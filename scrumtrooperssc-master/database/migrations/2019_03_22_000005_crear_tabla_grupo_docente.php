<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaGrupoDocente extends Migration
{
    public function up()
    {
        Schema::create('GRUPO_DOCENTE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('MATERIA_ID')->unsigned();
            
            $table->string('DETALLE_GRUPO_DOCENTE',255);
            $table->timestamps();
            
            $table->foreign('MATERIA_ID')->references('ID')->on('MATERIA')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('GRUPO_DOCENTE');
    }
}
