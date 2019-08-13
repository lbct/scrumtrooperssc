<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPeriodo extends Migration
{
    public function up()
    {
        Schema::create('periodo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            
            $table->string('descripcion',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('periodo');
    }
}
