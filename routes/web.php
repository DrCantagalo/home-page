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
            return view('popups.cookies')->with('lang', $lang);
        }
    });

    Route::post('changelanguage', [GlobalController::class, 'changelanguage']);

    Route::post('rememberme', [GlobalController::class, 'rememberme']);

    Route::post('cookiepermission', [GlobalController::class, 'cookiepermission']);

});