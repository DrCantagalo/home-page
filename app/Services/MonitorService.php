<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class MonitorServices
{
    public function initiatesignup(Request $request)
    {
        if(session('email_temp', false) || session('verification_code', false)){
            return back()->withErrors(['ERROR' => __('Wrong data.')])->withInput();
        }

        $request->validate([
            __('installation-code') => 'required|string',
            'email' => 'required|email',
        ]);

        if (!Hash::check($request->input(__('installation-code')), "IMPOSSIBLETOGUESS")) {
            return back()->withErrors([__('installation-code') => __('Invalid installation code.')])->withInput();
        }
        
        $email = $request->input('email');
        $verification_code = Str::random(14);
        $body = __("Welcome, dear user! We are sending the security code below to verify that this email is yours") . ".<br><br>";
        $body .= $verification_code . "<br><br>";
        $body .= __("This code must be entered on the page where you requested registration, in the \"Verification Code\" field.");
        
        //depois adicionar email laravel
        $SesClient = new SesClient([
            'version' => 'latest',
            'region'  => 'us-east-2',
        ]);

        try {
            $SesClient->sendEmail([
                'Source' => __('no-reply') . '@cantagalo.it',
                'Destination' => [
                    'ToAddresses' => [$email]
                ],
                'Message' => [
                    'Subject' => [
                        'Data' => __('Verifying your email') . ' - cantagalo.it',
                        'Charset' => 'UTF-8',
                    ],
                    'Body' => [
                        'Html' => [
                            'Data' => $body,
                            'Charset' => 'UTF-8',
                        ],
                    ],
                ],
            ]);
        } catch (AwsException $e) {
            Log::error('SES send failed: ' . $e->getAwsErrorMessage());
            return back()->withErrors(['email' => __("We couldn't send you the email with the verification code. Please try again later.")]);
        }

        Session::put('email_temp', $email);
        Session::put('verification_code', $verification_code);
        return back();
    }
    
    public function createuser(Request $request) {
        if(!session('email_temp', false) || !session('verification_code', false)){
            return back()->withErrors(['ERROR' => __('Wrong data.')])->withInput();
        }

        $validator = Validator::make($request->all(), [
            __('verification-code') => ['required', 'string', 'size:14'],
            __("created-password") => [
                'required',
                'string',
                Password::min(8)->mixedCase()->numbers()->symbols(),
            ],
            __('password-confirmation') => ['required', 'same:' . __("created-password")],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $sessionCode = session('verification_code', false);
        if ($sessionCode !== $request->input(__('verification-code'))) {
            return back()->withErrors([__('Verification code') => __("Invalid verification code.")]);
        }

        $email = session('email_temp', false);
        if (!$email) {
            return back()->withErrors(['email' => __('Session expired. Request a new code.')]);
        }

        try {
            User::create([
                'name' => 'USER' . Str::random(7) . time(),
                'email' => $email,
                'password' => Hash::make($request->input(__("created-password"))),
                'email_verified_at' => now(),
            ]);

            session()->forget(['email_temp', 'verification_code']);
            return redirect()->route('index')
                ->with(__('success'), __("Credentials created successfully, you can now log in."));
        } catch (\Exception $e) {
            Log::error('Error in user creation: ' . $e->getMessage());

            return back()->withErrors([
                __("internal error") => __("We had a problem registering your credentials. Please try again later.")
            ]);
        }
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        
        $email = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password], request()->filled('remember'))) {
            return back();
        }
        else{ return back()->withErrors(['email' => __('Invalid Credentials.')])->withInput(); }
    }
}
