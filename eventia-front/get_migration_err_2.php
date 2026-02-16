<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;

try {
    Artisan::call('migrate', ['--force' => true]);
    echo "Migration successful!\n";
} catch (\Exception $e) {
    echo "MIGRATION ERROR CAUGHT:\n";
    echo $e->getMessage() . "\n";
    if (method_exists($e, 'getPrevious') && $e->getPrevious()) {
        echo "PREVIOUS ERROR:\n";
        echo $e->getPrevious()->getMessage() . "\n";
    }
}
