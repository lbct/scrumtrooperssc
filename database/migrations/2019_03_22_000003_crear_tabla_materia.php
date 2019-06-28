<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMateria extends Migration
{
    public function up()
    {
        Schema::create('materia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('gestion_id')->unsigned();
            
            $table->string('codigo_materia',15);
            $table->string('nombre_materia',31);
            $table->string('detalle_materia',255);
            $table->timestamps();
            
            $table->foreign('gestion_id')->references('id')->on('gestion')->onDelete('cascade');
            
            $table->unique(['codigo_materia', 'gestion_id']);
        });
    }

    public function down()
    {
        Schema::drop('materia');
    }
}
