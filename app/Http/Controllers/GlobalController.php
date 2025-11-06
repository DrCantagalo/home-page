<?php

namespace App\Http\Controllers;

use App\Services\GlobalService;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    
    protected $handler;
    
    public function __construct(GlobalService $handler) {
        $this->handler = $handler;
    }

    public function changelanguage(Request $request) {
        return 'inside global controller';
        //return $this->handler->changelanguage($request);
    }

    public function rememberme(Request $request) {
        return $this->handler->rememberme($request);
    }

    public function cookiepermission(Request $request) {
        return $this->handler->cookiepermission($request);
    }
}
