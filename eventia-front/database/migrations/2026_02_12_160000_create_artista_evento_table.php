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
        Schema::create('artista_evento', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->integer('id_artista');
            $table->integer('id_evento');

            // Foreign Keys
            $table->foreign('id_artista')->references('id')->on('artistas')->onDelete('cascade');
            $table->foreign('id_evento')->references('id')->on('eventos')->onDelete('cascade');

            // Primary Key
            $table->primary(['id_artista', 'id_evento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artista_evento');
    }
};
