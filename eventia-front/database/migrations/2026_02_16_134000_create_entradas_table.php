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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->integer('id_evento');
            $table->string('categoria');
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_total', 10, 2);
            $table->string('codigo_ticket')->unique();
            $table->timestamp('fecha_compra')->useCurrent();
            
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_evento')->references('id')->on('eventos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
