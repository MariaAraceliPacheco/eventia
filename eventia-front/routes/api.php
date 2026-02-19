<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventoApiController;

Route::prefix('eventos')->group(function () {
    Route::get('/', [EventoApiController::class, 'index']);
    Route::get('/ayuntamiento/{id}', [EventoApiController::class, 'byAyuntamiento']);
    Route::get('/provincia/{provincia}', [EventoApiController::class, 'byProvincia']);
});
