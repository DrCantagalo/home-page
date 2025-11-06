<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

Route::middleware(['check.cookie'])->group(function () {

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

Route::middleware(['avoid.robots'])->group(function () {

    Route::get('cookies', function(){
        if(session('templang', false)) { 
            $lang = session('templang');
            App::setLocale($lang);
            session()->forget('templang');
        }
        else { 
            $lang = session('lang');
            App::setLocale($lang);
        }
        if(session('avoid_monitor')) { session()->forget('avoid_monitor'); }
        if (!session('show_cookie')) { return view('fallback'); }
        else {
            session()->forget('show_cookie');
            return view('popups.cookies')->with(['lang' => $lang, 'domain' => 'main']);
        }
    });

});