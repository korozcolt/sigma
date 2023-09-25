<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('departamento');
            $table->string('municipio');
            $table->string('puesto');
            $table->string('mesa');
            $table->string('direccion')->charset('utf8mb4')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_numbers');
    }
};
