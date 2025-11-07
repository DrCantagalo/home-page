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
        
        $request->validate([
            'lang' => 'required|in:en,it,pt', 
            'cookie-box' => 'nullable|boolean'
        ]);

        return $this->handler->changelanguage($request);
    }

    public function rememberme(Request $request) {
        
        $request->validate(['id-token' => 'required|max:30']);

        return $this->handler->rememberme($request);
    }

    public function cookiepermission(Request $request) {
        
        $request->validate([
            'id-token' => 'required_if:remember-decision,on|max:30',
            'visits' => 'required|integer|min:1'
        ]);

        return $this->handler->cookiepermission($request);
    }
}
