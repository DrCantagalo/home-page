<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\MonitorController;
use Illuminate\Support\Facades\Session;

Route::middleware(['set.locale', 'check.cookie'])->group(function () {

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

    Route::get('installationterms/{lang?}', function ($lang = 'en') {
        Session::put('lang', $lang);
        App::setLocale(session('lang'));
        return view('monitor.installationterms');
    });

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
            return view('popups.cookies')->with(['lang' => $lang, 'domain' => 'monitor']);
        }
        else { return view('fallback')->with('domain', 'monitor'); }
    });
    
});

Route::middleware(['set.locale', 'avoid.robots'])->group(function () {

    Route::post('signin', [MonitorController::class, 'signin']);

    Route::post('initiatesignup', [MonitorController::class, 'initiatesignup']);

    Route::post('createuser', [MonitorController::class, 'createuser']);

});
