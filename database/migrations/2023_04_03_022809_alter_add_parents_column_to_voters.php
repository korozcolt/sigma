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
        Schema::table('voters', function (Blueprint $table) {
            $table->enum('entity_parent', ['madre', 'padre', 'hijo', 'hermano', 'tio', 'abuelo', 'esposo', 'novio', 'amigo', 'suegro', 'cuñado', 'primo', 'yerno', 'nuero', 'nieto', 'sobrino'])->default('amigo')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voters', function (Blueprint $table) {
            //
        });
    }
};