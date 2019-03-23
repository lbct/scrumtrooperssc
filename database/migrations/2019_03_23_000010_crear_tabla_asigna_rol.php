<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsignaRol extends Migration
{
    public function up()
    {
        Schema::create('ASIGNA_ROL', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('USUARIO_ID')->unsigned();
            $table->integer('ROL_ID')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('USUARIO_ID')->references('ID')->on('USUARIO')->onDelete('cascade');
            $table->foreign('ROL_ID')->references('ID')->on('ROL')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('ASIGNA_ROL');
    }
}
