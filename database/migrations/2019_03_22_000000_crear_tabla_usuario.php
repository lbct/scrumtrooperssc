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
            
            $table->string('USERNAME', 15)->unique();;
            $table->string('PASSWORD', 100);
            
            $table->string('NOMBRE', 100);
            $table->string('APELLIDO', 100);
            $table->string('CORREO', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('USUARIO');
    }
}
