<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('estado');
            $table->string('registradopor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paises');
    }
}
