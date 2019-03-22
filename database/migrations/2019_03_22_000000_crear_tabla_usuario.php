<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration
{
    public function up()
    {
        Schema::create('USUARIO', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->string('NOMBRE_USUARIO', 25);
            $table->string('CONTRASENA', 32);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('USUARIO');
    }
}
