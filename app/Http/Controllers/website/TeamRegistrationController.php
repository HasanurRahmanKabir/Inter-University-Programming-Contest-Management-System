<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\TeamRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamRegistrationController extends Controller
{
    public function index()
    {
        return view('website.registration.registration');
    }

    public function checkDuplicateInDB(Request $request)
    {
        $field = $request->field_name;
        $value = $request->value;
        $exists = false;
        $message = "";

        if ($field == 'team_name') {
            $exists = TeamRegistration::where('team_name', $value)->exists();
            $message = "This Team Name is already taken!";
        } elseif (str_contains($field, 'email')) {
            $exists = TeamRegistration::where('coach_email', $value)
                ->orWhere('mem_1_email', $value)
                ->orWhere('mem_2_email', $value)
                ->orWhere('mem_3_email', $value)
                ->exists();

            $message = "This Email is already registered!";
        } elseif (str_contains($field, 'phone')) {
            $exists = TeamRegistration::where('coach_phone', $value)
                ->orWhere('mem_1_phone', $value)
                ->orWhere('mem_2_phone', $value)
                ->orWhere('mem_3_phone', $value)
                ->exists();

            $message = "This Phone Number is already registered!";
        } elseif (str_contains($field, 'student_id')) {
            $exists = TeamRegistration::where('mem_1_student_id', $value)
                ->orWhere('mem_2_student_id', $value)
                ->orWhere('mem_3_student_id', $value)
                ->exists();

            $message = "This Student ID is already registered!";
        }

        return response()->json(['exists' => $exists, 'message' => $message]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'captcha_verified' => 'required|in:1',
            'team_name' => 'required|string|max:255|unique:team_registration_infos,team_name',
            'institute_name' => 'nullable|string|max:255',
            'password' => 'required|confirmed|min:6',

            'coach_email' => 'required|email|unique:team_registration_infos,coach_email',
            'coach_phone' => 'required|unique:team_registration_infos,coach_phone',

            'mem_1_student_id' => 'required|unique:team_registration_infos,mem_1_student_id',
            'mem_1_email' => 'required|email|unique:team_registration_infos,mem_1_email',

            'mem_2_student_id' => 'required|unique:team_registration_infos,mem_2_student_id',
            'mem_2_email' => 'required|email|unique:team_registration_infos,mem_2_email',

            'mem_3_student_id' => 'required|unique:team_registration_infos,mem_3_student_id',
            'mem_3_email' => 'required|email|unique:team_registration_infos,mem_3_email',

            'coach_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mem_1_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mem_2_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mem_3_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $team = TeamRegistration::create([
            // Team Info
            'team_name' => $request->team_name,
            'institute_name' => $request->institute_name,
            'password' => Hash::make($request->password),

            // Coach Info
            'coach_name' => $request->coach_name,
            'coach_email' => $request->coach_email,
            'coach_phone' => $request->coach_phone,
            'coach_t_shirt' => $request->coach_t_shirt,
            'coach_photo' => $this->uploadImage($request->file('coach_photo'), 'coach'),

            // Member 1 Info
            'mem_1_name' => $request->mem_1_name,
            'mem_1_student_id' => $request->mem_1_student_id,
            'mem_1_email' => $request->mem_1_email,
            'mem_1_phone' => $request->mem_1_phone,
            'mem_1_t_shirt' => $request->mem_1_t_shirt,
            'mem_1_photo' => $this->uploadImage($request->file('mem_1_photo'), 'mem1'),

            // Member 2 Info
            'mem_2_name' => $request->mem_2_name,
            'mem_2_student_id' => $request->mem_2_student_id,
            'mem_2_email' => $request->mem_2_email,
            'mem_2_phone' => $request->mem_2_phone,
            'mem_2_t_shirt' => $request->mem_2_t_shirt,
            'mem_2_photo' => $this->uploadImage($request->file('mem_2_photo'), 'mem2'),

            // Member 3 Info
            'mem_3_name' => $request->mem_3_name,
            'mem_3_student_id' => $request->mem_3_student_id,
            'mem_3_email' => $request->mem_3_email,
            'mem_3_phone' => $request->mem_3_phone,
            'mem_3_t_shirt' => $request->mem_3_t_shirt,
            'mem_3_photo' => $this->uploadImage($request->file('mem_3_photo'), 'mem3'),

            'is_paid' => 0,
            'is_selected' => 0,
        ]);

        return redirect()->route('user.login')->with('success', 'Team registration completed successfully! Please login.');
    }

    private function uploadImage($file, $prefix)
    {
        if ($file) {
            $filename = $prefix . '_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/teams/';
            $file->move(public_path($path), $filename);

            return $path . $filename;
        }
        return null;
    }
}