<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GlobalService
{
    public function changelanguage(Request $request)
    {
        $request->validate([
            'lang' => 'required|in:en,it,pt', 
            'cookie-box' => 'nullable|boolean'
        ]);
        $lang = $request->input('lang');
        $cookie_box = $request->input('cookie-box', false);
        if($cookie_box) { 
            Session::put('templang', $lang);
            Session::put('show_cookie', $lang);
        }
        else {
            Session::put('lang', $lang);
            if(session('monitor_id', false)){
                $monitor = Monitor::find(session('monitor_id'));
                $monitor->data['lang'] = $lang;
                $monitor->save();
            }
        }
        Session::put('avoid_monitor', 1);
        return response()->json([
            'status' => 'ok',
            'action' => 'change-lang',
            'lang' => $lang
        ]);
    }

    public function rememberme(Request $request)
    {
        $request->validate(['id-token' => 'required|max:30']);
        $status = 'ok';
        $lang_changed = 0;
        $token = $request->input('id-token');
        Session::put('remember_me', $token);
        if(class_exists('Monitor\Models\Monitor')) {
            $user = Monitor::where('data->id-token', $token)->first();
            if ($user) {
                Session::put('permission', true);
                if (!empty($user->data['lang'])) {
                    $lang = $user->data['lang'];
                    if (session('lang') !== $lang) { 
                        Session::put('lang', $lang);
                        $lang_changed = 1;
                        Session::put('avoid_monitor', 1);
                    }
                }
            }
        }
        else { $status = 'error'; }

        return response()->json([
            'status' => $status,
            'action' => 'remember-me',
            'lang_changed' => $lang_changed
        ]);
    }

    public function cookiepermission(Request $request) {
        $request->validate([
            'id-token' => 'required_if:remember-decision,on|max:30',
            'visits' => 'required|integer|min:1'
        ]);
        $frontData = $request->except(['_token', 'remember-decision']);
        if(session('monitor_id', false)) {
            $monitor = Monitor::find(session('monitor_id'));
            foreach ($frontData as $key => $value) { $monitor->data[$key] = $value; }
        }
        $lang_changed = 0;
        if (!empty($frontData['ipapi_languages'])) {
            $lang = explode(',', $frontData['ipapi_languages'])[0];
            if (Str::contains($lang, 'it')) { $lang = 'it'; }
            elseif (Str::contains($lang, 'pt')) { $lang = 'pt'; }
            else { $lang = 'en'; }
            if(isset($monitor)) { $monitor->data['lang'] = $lang; }
            if (session('lang') !== $lang) { 
                Session::put('lang', $lang);
                $lang_changed = 1;
                Session::put('avoid_monitor', 1);
            }
        }
        else { if(isset($monitor)) { $monitor->data['lang'] = session('lang'); } }
        if(isset($monitor)) { $monitor->save(); }
        Session::put('permission', true);
        return response()->json([
            'status' => 'ok',
            'action' => 'cookie-permission',
            'lang_changed' => $lang_changed
        ]);
    }
}