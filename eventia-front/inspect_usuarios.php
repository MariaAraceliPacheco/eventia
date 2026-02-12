<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$columns = DB::select('SHOW FULL COLUMNS FROM usuarios');
foreach ($columns as $col) {
    echo "Column: " . $col->Field . " | Type: " . $col->Type . "\n";
}
