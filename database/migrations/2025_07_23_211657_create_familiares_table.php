<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatefamiliaresTable extends Migration
{
    public function up()
    {
        Schema::create('familiares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('habitante_id')->unsigned();
            $table->string('nombre');
            $table->string('parentezco');
            $table->string('celular');
            $table->string('direccion');
            $table->string('estado');
            $table->string('registradopor');
            $table->timestamps();
			$table->foreign('habitante_id')
                ->references('id')->on('habitantes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('familiares');
    }
}
