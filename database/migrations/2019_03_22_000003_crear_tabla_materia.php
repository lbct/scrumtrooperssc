<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMateria extends Migration
{
    public function up()
    {
        Schema::create('MATERIA', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('ID');
            
            $table->string('CODIGO_MATERIA',15)->unique();
            $table->string('NOMBRE_MATERIA',31);
            $table->string('DETALLE_MATERIA',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('MATERIA');
    }
}
