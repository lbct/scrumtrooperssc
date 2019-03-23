<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDocente extends Migration
{
    public function up()
    {
        Schema::create('DOCENTE', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            $table->integer('USUARIO_ID')->unsigned();
            $table->timestamps();
            
            $table->foreign('USUARIO_ID')->references('ID')->on('USUARIO')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('DOCENTE');
    }
}
