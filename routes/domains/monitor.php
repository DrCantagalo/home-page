<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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

Route::middleware(['avoid.robots', 'check.cookie'])->group(function () {

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
            return view('popups.cookies')->with(['lang' => $lang, 'domain' => 'monitor']);
        }
    });

    Route::post('signin', [MonitorController::class, 'signin']);

    Route::post('initiatesignup', [MonitorController::class, 'initiatesignup']);

    Route::post('createuser', [MonitorController::class, 'createuser']);

});
