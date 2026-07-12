<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Models\TeamRegistration;
use App\Models\Volunteer;
use App\Models\PasswordResetOtp;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        $setting = WebsiteSetting::first();
        return view('website.login.forgot_password', compact('setting'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $team = TeamRegistration::where('coach_email', $request->email)->first();
        $volunteer = Volunteer::where('email', $request->email)->first();

        if (!$team && !$volunteer) {
            return back()->withErrors(['email' => 'We could not find any account with that email address.']);
        }

        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        PasswordResetOtp::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(10)]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($otp));

        $request->session()->put('reset_email', $request->email);

        return redirect()->route('forgot.password.verify')->with('success', 'OTP has been sent to your email.');
    }

    public function showOtpForm(Request $request)
    {
        if (!$request->session()->has('reset_email')) {
            return redirect()->route('forgot.password');
        }
        $setting = WebsiteSetting::first();
        return view('website.login.verify_otp', compact('setting'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);
        $email = $request->session()->get('reset_email');

        $reset = PasswordResetOtp::where('email', $email)->where('otp', $request->otp)->first();

        if (!$reset || Carbon::now()->gt($reset->expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $request->session()->put('otp_verified', true);
        return redirect()->route('forgot.password.reset')->with('success', 'OTP verified successfully. Please enter your new password.');
    }

    public function showResetForm(Request $request)
    {
        if (!$request->session()->has('otp_verified')) {
            return redirect()->route('forgot.password');
        }
        $setting = WebsiteSetting::first();
        return view('website.login.reset_password', compact('setting'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        $email = $request->session()->get('reset_email');
        
        $team = TeamRegistration::where('coach_email', $email)->first();
        if ($team) {
            $team->password = Hash::make($request->new_password);
            $team->save();
        }

        $volunteer = Volunteer::where('email', $email)->first();
        if ($volunteer) {
            $volunteer->password = Hash::make($request->new_password);
            $volunteer->save();
        }

        PasswordResetOtp::where('email', $email)->delete();
        $request->session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('user.login')->with('success', 'Password reset successfully. You can now login.');
    }
}
