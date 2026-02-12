<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "Deleting migration entries...\n";
    DB::table('migrations')->where('migration', 'like', '%eventos%')->delete();
    echo "Migration entries deleted.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
