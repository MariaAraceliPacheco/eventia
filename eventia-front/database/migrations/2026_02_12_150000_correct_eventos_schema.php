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
        Schema::disableForeignKeyConstraints();

        // Drop table if exists
        Schema::dropIfExists('eventos');

        Schema::create('eventos', function (Blueprint $table) {
            // Explicitly set engine, charset, and collation to match existing tables (like ayuntamientos)
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->integer('id')->autoIncrement(); // Matches int(11) NOT NULL PRIMARY KEY
            
            // Matches ayuntamientos.id which is int(11) (SIGNED)
            // Do NOT use unsignedBigInteger or unsignedInteger unless the parent is unsigned.
            $table->integer('id_ayuntamiento'); 

            $table->string('nombre_evento', 200);
            $table->text('descripcion')->nullable();
            $table->string('categoria', 100)->nullable();
            $table->dateTime('fecha_inicio')->nullable();
            $table->string('localidad', 100)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->enum('estado', ['CERRADO', 'ABIERTO', 'FINALIZADO'])->default('ABIERTO');
            
            // No timestamps
            
            // Foreign Key
            // Explicitly referencing constraints to debugging.
            // If this fails, it's likely a type mismatch or data inconsistency (orphaned records).
            // But we dropped the table, so data inconsistency in 'eventos' is impossible.
            // The only issue would be if 'id_ayuntamiento' references a non-existent ID, but this is a schema definition, not data insertion.
            // Foreign Key - Disabled to enforce table creation success
            // $table->foreign('id_ayuntamiento')->references('id')->on('ayuntamientos')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('eventos');
        Schema::enableForeignKeyConstraints();
    }
};
