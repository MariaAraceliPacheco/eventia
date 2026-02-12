<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "Disabling FK checks...\n";
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    echo "Dropping view 'eventos' if exists...\n";
    DB::statement('DROP VIEW IF EXISTS eventos');
    
    echo "Dropping table 'eventos' if exists...\n";
    DB::statement('DROP TABLE IF EXISTS eventos');
    
    echo "Enabling FK checks...\n";
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    echo "Cleaned up 'eventos'.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
