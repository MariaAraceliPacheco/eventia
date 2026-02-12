<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    Schema::disableForeignKeyConstraints();
    echo "Dropping table...\n";
    Schema::dropIfExists('eventos');
    echo "Table dropped.\n";
    
    echo "Creating table...\n";
    Schema::create('eventos', function (Blueprint $table) {
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_general_ci';
        $table->id();
        $table->unsignedBigInteger('id_ayuntamiento');
        $table->string('nombre_evento', 200);
        $table->text('descripcion')->nullable();
        $table->string('categoria', 100)->nullable();
        $table->dateTime('fecha_inicio')->nullable();
        $table->string('localidad', 100)->nullable();
        $table->string('provincia', 100)->nullable();
        $table->decimal('precio', 10, 2)->nullable();
        $table->enum('estado', ['CERRADO', 'ABIERTO', 'FINALIZADO'])->default('ABIERTO');
    });
    
    Schema::enableForeignKeyConstraints();
    echo "Success!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
