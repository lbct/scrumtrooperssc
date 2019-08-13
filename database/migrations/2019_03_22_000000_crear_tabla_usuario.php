<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuario extends Migration
{
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->string('username', 63)->unique();;
            $table->string('password', 100);
            
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('correo', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('usuario');
    }
}
