<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use App\Models\Contest;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CoachController extends Controller
{
    public function index()
    {
        $setting = WebsiteSetting::first();
        $user = Auth::guard('team')->user();
        $payment = Payment::where('team_name', $user->team_name)->first();
        $contest = Contest::latest('contest_id')->first();

        return view('website.coach.index', compact('user', 'payment', 'contest', 'setting'));
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string|max:50',
            'transaction_id' => 'required|string|max:100|regex:/^[A-Za-z0-9\-_]+$/',
        ], [
            'transaction_id.regex' => 'The transaction ID may only contain letters, numbers, dashes, and underscores.',
        ]);

        $team = Auth::guard('team')->user();

        Payment::updateOrCreate(
            ['team_name' => $team->team_name],
            [
                'platform' => $request->payment_method,
                'amount' => 1500.00,
                'transaction_id' => trim($request->transaction_id),
                'payment_status' => 0
            ]
        );

        return redirect()->back()->with('success', 'Payment Info Submitted Successfully! Wait for Verification.');
    }

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('coach.dashboard');
        }

        $team = Auth::guard('team')->user();

        if (!$team) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your session has expired. Please log in again.'
                ], 401);
            }
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

        $team = Auth::guard('team')->user();

        $request->validate([
            'coach_name' => 'required|string|max:255',
            'coach_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'coach_t_shirt' => 'required',
            'coach_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'coach_photo_base64' => 'nullable|string',

            // Member 1 Validation (Required as per database schema)
            'mem_1_name' => 'required|string|max:255',
            'mem_1_student_id' => 'required|string|max:100|unique:team_registration_infos,mem_1_student_id,' . $team->team_id . ',team_id',
            'mem_1_email' => 'required|email|max:255|unique:team_registration_infos,mem_1_email,' . $team->team_id . ',team_id',
            'mem_1_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_1_t_shirt' => 'nullable|string|max:10',
            'mem_1_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'mem_1_photo_base64' => 'nullable|string',

            // Member 2 Validation
            'mem_2_name' => 'required|string|max:255',
            'mem_2_student_id' => 'required|string|max:100|unique:team_registration_infos,mem_2_student_id,' . $team->team_id . ',team_id',
            'mem_2_email' => 'required|email|max:255|unique:team_registration_infos,mem_2_email,' . $team->team_id . ',team_id',
            'mem_2_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_2_t_shirt' => 'nullable|string|max:10',
            'mem_2_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'mem_2_photo_base64' => 'nullable|string',

            // Member 3 Validation
            'mem_3_name' => 'required|string|max:255',
            'mem_3_student_id' => 'required|string|max:100|unique:team_registration_infos,mem_3_student_id,' . $team->team_id . ',team_id',
            'mem_3_email' => 'required|email|max:255|unique:team_registration_infos,mem_3_email,' . $team->team_id . ',team_id',
            'mem_3_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_3_t_shirt' => 'nullable|string|max:10',
            'mem_3_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'mem_3_photo_base64' => 'nullable|string',

            // Password update (Optional - Leave blank to keep current)
            'new_password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
                function ($attribute, $value, $fail) use ($team) {
                    if (!empty($value) && $team && !empty($team->password)) {
                        if (Hash::check($value, $team->password)) {
                            $fail('New password cannot be the same as your current password.');
                        }
                    }
                },
            ],
        ], [
            'coach_name.required' => 'Coach name is required.',
            'coach_phone.required' => 'Coach phone number is required.',
            'coach_phone.regex' => 'Coach phone number must contain only digits (0-9), +, and -.',

            'new_password.min' => 'New password must be at least 6 characters.',
            'new_password.confirmed' => 'Confirm password does not match new password.',

            'mem_1_name.required' => 'Member 1 name is required.',
            'mem_1_student_id.required' => 'Member 1 Student ID is required.',
            'mem_1_student_id.unique' => 'Member 1 Student ID is already taken by another team.',
            'mem_1_email.required' => 'Member 1 email address is required.',
            'mem_1_email.email' => 'Member 1 email must be a valid email address.',
            'mem_1_email.unique' => 'Member 1 email is already registered with another team.',
            'mem_1_phone.regex' => 'Member 1 phone number must contain only digits (0-9), +, and -.',

            'mem_2_name.required' => 'Member 2 name is required.',
            'mem_2_student_id.required' => 'Member 2 Student ID is required.',
            'mem_2_student_id.unique' => 'Member 2 Student ID is already taken by another team.',
            'mem_2_email.required' => 'Member 2 email address is required.',
            'mem_2_email.email' => 'Member 2 email must be a valid email address.',
            'mem_2_email.unique' => 'Member 2 email is already registered with another team.',
            'mem_2_phone.regex' => 'Member 2 phone number must contain only digits (0-9), +, and -.',

            'mem_3_name.required' => 'Member 3 name is required.',
            'mem_3_student_id.required' => 'Member 3 Student ID is required.',
            'mem_3_student_id.unique' => 'Member 3 Student ID is already taken by another team.',
            'mem_3_email.required' => 'Member 3 email address is required.',
            'mem_3_email.email' => 'Member 3 email must be a valid email address.',
            'mem_3_email.unique' => 'Member 3 email is already registered with another team.',
            'mem_3_phone.regex' => 'Member 3 phone number must contain only digits (0-9), +, and -.',
        ]);

        $data = $request->except([
            'coach_photo', 'coach_photo_base64', 'mem_1_photo', 'mem_1_photo_base64',
            'mem_2_photo', 'mem_2_photo_base64', 'mem_3_photo', 'mem_3_photo_base64',
            'remove_coach_photo', 'remove_mem_1_photo', 'remove_mem_2_photo', 'remove_mem_3_photo',
            'new_password', 'new_password_confirmation',
            '_token', '_method'
        ]);

        // Coach Photo Removal or Upload (Base64 + File)
        if ($request->has('remove_coach_photo') && $request->remove_coach_photo == '1') {
            if ($team->coach_photo && File::exists(public_path($team->coach_photo))) {
                File::delete(public_path($team->coach_photo));
            }
            $data['coach_photo'] = null;
        } else {
            $newCoachPhoto = $this->saveCoachImageFromBase64OrFile($request, 'coach_photo', 'coach');
            if ($newCoachPhoto) {
                if ($team->coach_photo && File::exists(public_path($team->coach_photo))) {
                    File::delete(public_path($team->coach_photo));
                }
                $data['coach_photo'] = $newCoachPhoto;
            }
        }

        // Member 1 Photo Removal or Upload (Base64 + File)
        if ($request->has('remove_mem_1_photo') && $request->remove_mem_1_photo == '1') {
            if ($team->mem_1_photo && File::exists(public_path($team->mem_1_photo))) {
                File::delete(public_path($team->mem_1_photo));
            }
            $data['mem_1_photo'] = null;
        } else {
            $newMem1Photo = $this->saveCoachImageFromBase64OrFile($request, 'mem_1_photo', 'mem1');
            if ($newMem1Photo) {
                if ($team->mem_1_photo && File::exists(public_path($team->mem_1_photo))) {
                    File::delete(public_path($team->mem_1_photo));
                }
                $data['mem_1_photo'] = $newMem1Photo;
            }
        }

        // Member 2 Photo Removal or Upload (Base64 + File)
        if ($request->has('remove_mem_2_photo') && $request->remove_mem_2_photo == '1') {
            if ($team->mem_2_photo && File::exists(public_path($team->mem_2_photo))) {
                File::delete(public_path($team->mem_2_photo));
            }
            $data['mem_2_photo'] = null;
        } else {
            $newMem2Photo = $this->saveCoachImageFromBase64OrFile($request, 'mem_2_photo', 'mem2');
            if ($newMem2Photo) {
                if ($team->mem_2_photo && File::exists(public_path($team->mem_2_photo))) {
                    File::delete(public_path($team->mem_2_photo));
                }
                $data['mem_2_photo'] = $newMem2Photo;
            }
        }

        // Member 3 Photo Removal or Upload (Base64 + File)
        if ($request->has('remove_mem_3_photo') && $request->remove_mem_3_photo == '1') {
            if ($team->mem_3_photo && File::exists(public_path($team->mem_3_photo))) {
                File::delete(public_path($team->mem_3_photo));
            }
            $data['mem_3_photo'] = null;
        } else {
            $newMem3Photo = $this->saveCoachImageFromBase64OrFile($request, 'mem_3_photo', 'mem3');
            if ($newMem3Photo) {
                if ($team->mem_3_photo && File::exists(public_path($team->mem_3_photo))) {
                    File::delete(public_path($team->mem_3_photo));
                }
                $data['mem_3_photo'] = $newMem3Photo;
            }
        }

        // Update password if user entered a new password; otherwise leave current password unchanged
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        try {
            $team->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile & Team Information Updated Successfully!'
                ]);
            }

            return redirect()->back()->with('success', 'Profile & Team Information Updated Successfully!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Profile update failed: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update profile: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Failed to update profile. Please verify that all required fields are filled correctly.');
        }
    }

    private function saveCoachImageFromBase64OrFile(Request $request, $fieldName, $prefix)
    {
        $base64Field = $fieldName . '_base64';

        // 1. Process Base64 data (Bypasses OpenResty / restrictive WAF 403 on multipart uploads)
        if ($request->filled($base64Field)) {
            $base64Data = $request->input($base64Field);
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Data, $type)) {
                $data = substr($base64Data, strpos($base64Data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, jpeg, webp

                if (in_array($type, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $decoded = base64_decode($data);
                    if ($decoded !== false) {
                        $targetDir = public_path('uploads/teams');
                        if (!File::isDirectory($targetDir)) {
                            File::makeDirectory($targetDir, 0755, true, true);
                        }
                        $filename = $prefix . '_' . time() . '_' . rand(1000, 9999) . '.' . ($type === 'jpeg' ? 'jpg' : $type);
                        file_put_contents($targetDir . DIRECTORY_SEPARATOR . $filename, $decoded);
                        return 'uploads/teams/' . $filename;
                    }
                }
            }
        }

        // 2. Standard Multipart File Upload Fallback
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            if ($file && $file->isValid()) {
                $targetDir = public_path('uploads/teams');
                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true, true);
                }
                $filename = $prefix . '_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $file->move($targetDir, $filename);
                return 'uploads/teams/' . $filename;
            }
        }

        return null;
    }
}