<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
Illuminate\Support\Facades\Schema::dropIfExists('solicitudes');
Illuminate\Support\Facades\Schema::dropIfExists('solicitudes_debug');
echo "Tables dropped successfully.\n";
