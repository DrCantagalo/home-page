<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\APIService;

class APIController extends Controller
{
    protected $handler;
    
    public function __construct(APIService $handler) {
        $this->handler = $handler;
    }
}
