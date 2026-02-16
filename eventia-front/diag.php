<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function showCreate($table) {
    try {
        $res = DB::select("SHOW CREATE TABLE $table");
        $out = "--- $table ---\n";
        $out .= $res[0]->{'Create Table'} . "\n\n";
        file_put_contents('schema_diag.txt', $out, FILE_APPEND);
    } catch (\Exception $e) {
        file_put_contents('schema_diag.txt', "ERROR for $table: " . $e->getMessage() . "\n", FILE_APPEND);
    }
}

file_put_contents('schema_diag.txt', ""); // Clear file
showCreate('usuarios');
showCreate('eventos');
echo "Done! Check schema_diag.txt\n";
