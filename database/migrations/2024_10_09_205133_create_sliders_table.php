<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string ('titulo');
            $table-> string('nombre_boton');
            $table->string('descripcion')->nullable();
            $table->string('link_boton')->nullable();
            $table->string ('imagen');
            $table->boolean('estado')->default(1); // Ejemplo de valor por defecto `1` para 'activo'
            $table-> string ('registradopor');
            
            $table-> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
