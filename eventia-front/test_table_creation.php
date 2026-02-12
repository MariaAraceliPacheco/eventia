<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

try {
    echo "Attempting to create 'eventos_test' table...\n";
    Schema::dropIfExists('eventos_test');
    
    Schema::create('eventos_test', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->charset = 'utf8mb4';
        $table->collation = 'utf8mb4_general_ci';
        $table->integer('id')->autoIncrement();
        $table->string('nombre', 200);
        $table->enum('estado', ['A', 'B'])->default('A');
    });
    
    echo "Success! 'eventos_test' created.\n";
    Schema::dropIfExists('eventos_test');
    echo "Table dropped.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
