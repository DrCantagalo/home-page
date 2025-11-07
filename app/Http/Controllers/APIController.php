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

    public function registerinstallation(Request $request){
        
        $request->validate([
            'site_url' => 'required|url',
            'package_version' => 'required|string',
            'installation_hash' => 'required|string',
        ]);

        return $this->handler->registerinstallation($request);

    }
}
