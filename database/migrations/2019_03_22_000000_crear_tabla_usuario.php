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
            
            $table->string('CODIGO_SIS', 15);
            $table->string('CONTRASENA', 100);
            
            $table->string('NOMBRE', 100);
            $table->string('APELLIDO', 100);
            $table->string('CORREO', 255);
            $table->string('SEXO',1);
            $table->string('TELEFONO');
            $table->string('CI');
            $table->date('FECHA_NACIMIENTO');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('USUARIO');
    }
}
