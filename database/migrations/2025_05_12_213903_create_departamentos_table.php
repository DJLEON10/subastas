<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pais_id')->unsigned();
            $table->string('nombre');
            $table->string('estado');
            $table->string('registradopor');
            $table->timestamps();
			$table->foreign('pais_id')
                ->references('id')->on('paises');
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}
