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
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id'); // Crea un campo `id` auto-incrementable
            $table->string('name', 100); // Nombre de la película
            $table->integer('year'); // Año de lanzamiento
            $table->string('genre', 50); // Género de la película
            $table->string('country', 30); // País de origen
            $table->integer('duration'); // Duración en minutos
            $table->string('img_url', 255); // URL de imagen asociada
            $table->timestamps(); // Campos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
