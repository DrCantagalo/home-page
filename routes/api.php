<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::middleware(['avoid.robots'])->group(function () {

    Route::post('registerinstallation', [APIController::class, 'registerinstallation'])->middleware('throttle:2,1');

});
