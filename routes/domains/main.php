<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['set.locale', 'check.cookie'])->group(function () {

    Route::get('/', function () {
        return view('main.index');
    })->name('main.index');

    Route::fallback(function () {
        return view('fallback')->with('domain', 'main');
    });

    Route::get('legal', function () {
        return view('legal')->with('domain', 'main');
    })->name('main.legal');

});