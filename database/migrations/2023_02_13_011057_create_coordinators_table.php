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
        Schema::create('coordinators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dni')->unsigned()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->bigInteger('phone');
            $table->string('address')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->enum(['revisado', 'pendiente', 'activo', 'llamado', 'cuelga', 'no_responde', 'positivo', 'negativo', 'blanco', 'otro_candidato', 'numero_equivocado', 'numero_no_existe', 'numero_mal_escrito'])->nullable();
            $table->string('debate_boss')->nullable();
            $table->string('candidate')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('place_id')->constrained('places')->onDelete('cascade');
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
        Schema::dropIfExists('coordinators');
    }
};
