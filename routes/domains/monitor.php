<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitorController;

Route::middleware(['check.cookie'])->group(function () {

    Route::get('/', function () {
        if(auth()->guest()) { return view('monitor.index'); }
        return view('monitor.monitor');
    })->name('monitor.index');

    Route::fallback(function () {
        return view('fallback')->with('domain', 'monitor');
    });

    Route::get('legal', function () {
        return view('legal')->with('domain', 'monitor');
    })->name('monitor.legal');

    Route::get('signup', function () {
        return view('monitor.signup');
    })->name('monitor.signup');

    Route::get('password', function () {
        return view('monitor.password');
    })->name('monitor.password');

});

Route::middleware(['avoid.robots'])->group(function () {

    Route::post('signin', [MonitorController::class, 'signin']);

    Route::post('initiatesignup', [MonitorController::class, 'initiatesignup']);

    Route::post('createuser', [MonitorController::class, 'createuser']);

});
