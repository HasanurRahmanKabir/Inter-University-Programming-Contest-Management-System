<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Controller
{
    public function index()
    {
        $setting = WebsiteSetting::first();
        return view('admin.auth.login' , compact('setting'));
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {

            if (Auth::guard('admin')->user()->status == 0) {
                Auth::guard('admin')->logout();
                return back()->with('inactive_account', 'Your Account is Currently Inactive. Please Contact With Administrators To Active Your Account and Access your account.');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome Back, Admin!');
        }


        return back()->withErrors([
            'email' => 'The Provided Credentials Do Not Match Our Records.',
        ])->withInput($request->only('email'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged Out Successfully.');
    }
}