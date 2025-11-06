<?php

namespace App\Http\Controllers;

use App\Services\MonitorService;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    protected $handler;
    
    public function __construct(MonitorService $handler) {
        $this->handler = $handler;
    }

    public function signin(Request $request) {
        return $this->handler->signin($request);
    }

    public function initiatesignup(Request $request) {
        return $this->handler->initiatesignup($request);
    }

        public function createuser(Request $request) {
        return $this->handler->createuser($request);
    }
}
