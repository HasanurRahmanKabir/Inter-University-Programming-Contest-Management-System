<?php

namespace App\Http\Controllers\website;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Controller
{

    public function index()
    {
        $contestinfo = Contest::where('status', 1)->first();
        $today = Carbon::today();
        $isRegistrationOpen = false;

        if ($contestinfo) {
            $startDate = Carbon::parse($contestinfo->registration_start_date);
            $endDate = Carbon::parse($contestinfo->registration_end_date);

            if ($today->between($startDate, $endDate)) {
                $isRegistrationOpen = true;
            }
        }
        return view('website.login.user_login', compact('isRegistrationOpen'));
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $teamCredentials = [
            'coach_email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('team')->attempt($teamCredentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('coach.dashboard'))
                ->with('success', 'Welcome Coach!');
        }

        $volunteerCredentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('volunteer')->attempt($volunteerCredentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('volunteer.dashboard'))
                ->with('success', 'Welcome Volunteer!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {

        if (Auth::guard('team')->check()) {
            Auth::guard('team')->logout();
        } elseif (Auth::guard('volunteer')->check()) {
            Auth::guard('volunteer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('user.login');
    }
}