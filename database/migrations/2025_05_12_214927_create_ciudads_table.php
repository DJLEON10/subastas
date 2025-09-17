<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadsTable extends Migration
{
    public function up()
    {
        Schema::create('ciudads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('departamento_id')->unsigned();
            $table->string('nombre');
            $table->string('estado');
            $table->string('registradopor');
            $table->timestamps();
			$table->foreign('departamento_id')
                ->references('id')->on('departamentos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ciudads');
    }
}
