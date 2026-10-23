<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin_infos,email,' . $admin->admin_id . ',admin_id',
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
        ], [
            'phone.regex' => 'The phone number may only contain digits (0-9), +, and -.',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('profile_success', 'Profile Updated Successfully.');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // 1. Current Password Validation (required & must match current hash)
        $request->validate([
            'current_password' => 'required',
        ], [
            'current_password.required' => 'Please enter your current password.',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withInput()->withErrors(['current_password' => 'Current Password Does Not Match.']);
        }

        // 2. New Password Validation (required, min:6, confirmed)
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 6 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        // 3. Password Reuse Check (New password must not be identical to current password)
        if (Hash::check($request->new_password, $admin->password)) {
            return back()->withInput()->withErrors([
                'new_password' => 'New password cannot be the same as your current password. Please choose a different password.'
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('profile_success', 'Password Changed Successfully.');
    }
}
