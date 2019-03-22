<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAdministrador extends Migration
{
    public function up()
    {
        Schema::create('ADMINISTRADOR', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('PERSONA_ID')->unsigned();
            $table->timestamps();
            
            $table->foreign('PERSONA_ID')->references('ID')->on('PERSONA')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('ADMINISTRADOR');
    }
}
