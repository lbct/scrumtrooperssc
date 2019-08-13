<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAdministrador extends Migration
{
    public function up()
    {
        Schema::create('administrador', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('administrador');
    }
}
