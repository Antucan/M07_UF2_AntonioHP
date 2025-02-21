<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films_actors', function (Blueprint $table) {
            // id de la pelicula de la tabla films
            $table->unsignedBigInteger('film_id');
            // id del actor de la tabla actors
            $table->unsignedBigInteger('actor_id');
            $table->timestamps();
            // Clave primaria compuesta
            $table->primary(['film_id', 'actor_id']);
            // Clave foránea de actor_id
            $table->foreign('film_id')->references('id')->on('films');
            $table->foreign('actor_id')->references('id')->on('actors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films_actors');
    }
};
