<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('habitantes', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('tipodocumento_id')->unsigned();
			$table->bigInteger('ciudad_id')->unsigned();
            $table->string('nombre');
            $table->string('apellido');
			$table->string('descripcion');
            $table->string('comuna');
            $table->string('numerodocumento');
			$table->string('image');
            $table->string('estado');
            $table->string('registradopor');
            $table->timestamps();
			$table->foreign('tipodocumento_id')
                ->references('id')->on('tipodocumentos');
			$table->foreign('ciudad_id')
                ->references('id')->on('ciudads');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('habitantes');
    }
};