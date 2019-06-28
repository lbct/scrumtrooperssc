<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsignaRol extends Migration
{
    public function up()
    {
        Schema::create('asigna_rol', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('rol_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('asigna_rol');
    }
}
