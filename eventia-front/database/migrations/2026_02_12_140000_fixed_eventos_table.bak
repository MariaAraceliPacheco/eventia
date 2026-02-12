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
            $table->id(); // Standard Laravel BigInt ID
            $table->unsignedBigInteger('id_ayuntamiento'); // Standard Laravel foreign key type
            $table->string('nombre_evento', 200);
            $table->text('descripcion')->nullable();
            $table->string('categoria', 100)->nullable();
            $table->dateTime('fecha_inicio')->nullable();
            $table->string('localidad', 100)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->enum('estado', ['CERRADO', 'ABIERTO', 'FINALIZADO'])->default('ABIERTO');
            
            // Note: Timestamps are NOT added as they are not in the dump.
            
            // No FK defined here to ensure creation. It can be added later if needed.
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
