<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$columns = DB::select('SHOW FULL COLUMNS FROM ayuntamientos');
foreach ($columns as $col) {
    if ($col->Field === 'id') {
        echo "ID Column Type: " . $col->Type . "\n";
        echo "ID Collation: " . $col->Collation . "\n";
    }
}

$tables = DB::select('SHOW TABLE STATUS WHERE Name = "ayuntamientos"');
echo "Table Engine: " . $tables[0]->Engine . "\n";
echo "Table Collation: " . $tables[0]->Collation . "\n";
