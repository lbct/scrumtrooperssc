<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsignaFuncion extends Migration
{
    public function up()
    {
        Schema::create('asigna_funcion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('rol_id')->unsigned();
            $table->integer('funcion_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');
            $table->foreign('funcion_id')->references('id')->on('funcion')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('asigna_funcion');
    }
}
