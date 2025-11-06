<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;

Route::domain('cantagalo.it')->group(function () {
    require base_path('routes/domains/main.php');
});

Route::domain('monitor.cantagalo.it')->group(function () {
    require base_path('routes/domains/monitor.php');
});

Route::middleware(['avoid.robots'])->group(function () {

    Route::post('changelanguage', [GlobalController::class, 'changelanguage']);

    Route::post('rememberme', [GlobalController::class, 'rememberme']);

    Route::post('cookiepermission', [GlobalController::class, 'cookiepermission']);

});