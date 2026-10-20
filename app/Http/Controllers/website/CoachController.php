<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use App\Models\Contest;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoachController extends Controller
{
    public function index()
    {
        $setting = WebsiteSetting::first();
        $user = Auth::guard('team')->user();
        $payment = Payment::where('team_name', $user->team_name)->first();
        $contest = Contest::latest('contest_id')->first();

        return view('website.coach.coach', compact('user', 'payment', 'contest', 'setting'));
    }

    public function storePayment(Request $request)
    {
        $team = Auth::guard('team')->user();

        Payment::updateOrCreate(
            ['team_name' => $team->team_name],
            [
                'platform' => $request->payment_method,
                'amount' => 1500.00,
                'transaction_id' => $request->transaction_id,
                'payment_status' => 0
            ]
        );

        return redirect()->back()->with('success', 'Payment Info Submitted Successfully! Wait for Verification.');
    }

    public function updateProfile(Request $request)
    {
        $team = Auth::guard('team')->user();

        if (!$team) {
            return redirect()->back()->with('error', 'Team not found or session expired.');
        }

        $cleanedCoachPhone = $request->coach_phone ? preg_replace('/\s+/', '', $request->coach_phone) : null;
        $cleanedMem1Phone = $request->mem_1_phone ? preg_replace('/\s+/', '', $request->mem_1_phone) : null;
        $cleanedMem2Phone = $request->mem_2_phone ? preg_replace('/\s+/', '', $request->mem_2_phone) : null;
        $cleanedMem3Phone = $request->mem_3_phone ? preg_replace('/\s+/', '', $request->mem_3_phone) : null;

        $request->merge([
            'coach_phone' => $cleanedCoachPhone,
            'mem_1_phone' => $cleanedMem1Phone,
            'mem_2_phone' => $cleanedMem2Phone,
            'mem_3_phone' => $cleanedMem3Phone,
        ]);

        $request->validate([
            'coach_name' => 'required|string|max:255',
            'coach_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'coach_t_shirt' => 'required',
            'coach_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mem_1_name' => 'nullable|string|max:255',
            'mem_1_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_2_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_3_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
        ], [
            'coach_phone.regex' => 'Coach phone number must contain only digits (0-9), +, and -.',
            'mem_1_phone.regex' => 'Member 1 phone number must contain only digits (0-9), +, and -.',
            'mem_2_phone.regex' => 'Member 2 phone number must contain only digits (0-9), +, and -.',
            'mem_3_phone.regex' => 'Member 3 phone number must contain only digits (0-9), +, and -.',
        ]);

        $data = $request->except(['coach_photo', 'mem_1_photo', 'mem_2_photo', 'mem_3_photo', '_token', '_method']);

        if ($request->hasFile('coach_photo')) {

            if ($team->coach_photo && File::exists(public_path($team->coach_photo))) {
                File::delete(public_path($team->coach_photo));
            }
            $file = $request->file('coach_photo');
            $filename = 'coach_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $data['coach_photo'] = 'uploads/teams/' . $filename;
        }

        if ($request->hasFile('mem_1_photo')) {
            if ($team->mem_1_photo && File::exists(public_path($team->mem_1_photo))) {
                File::delete(public_path($team->mem_1_photo));
            }
            $file = $request->file('mem_1_photo');
            $filename = 'mem1_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $data['mem_1_photo'] = 'uploads/teams/' . $filename;
        }

        if ($request->hasFile('mem_2_photo')) {
            if ($team->mem_2_photo && File::exists(public_path($team->mem_2_photo))) {
                File::delete(public_path($team->mem_2_photo));
            }
            $file = $request->file('mem_2_photo');
            $filename = 'mem2_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $data['mem_2_photo'] = 'uploads/teams/' . $filename;
        }

        if ($request->hasFile('mem_3_photo')) {
            if ($team->mem_3_photo && File::exists(public_path($team->mem_3_photo))) {
                File::delete(public_path($team->mem_3_photo));
            }
            $file = $request->file('mem_3_photo');
            $filename = 'mem3_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $data['mem_3_photo'] = 'uploads/teams/' . $filename;
        }

        $team->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile & Team Information Updated Successfully!'
            ]);
        }

        return redirect()->back()->with('success', 'Profile & Team Information Updated Successfully!');
    }
}