<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::middleware(['avoid.robots'])->group(function () {

    Route::post('registerinstallation', [APIController::class, 'registerinstallation'])->middleware('throttle:10,1');

});
