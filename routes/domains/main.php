<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Route::middleware(['avoid.robots'])->group(function () {

    Route::get('cookies', function(){
        if(session('templang', false)) { 
            $lang = session('templang');
            session()->forget('templang');
        }
        else { $lang = session('lang', 'en'); }
        if(session('avoid_monitor')) { session()->forget('avoid_monitor'); }
        if (session('show_cookie')) { 
            session()->forget('show_cookie');
            App::setLocale($lang);
            return view('popups.cookies')->with(['lang' => $lang, 'domain' => 'main']);
        }
        else { return view('fallback')->with('domain', 'main'); }
    });

});