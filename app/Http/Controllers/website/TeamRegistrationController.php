<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\TeamRegistration;
use App\Models\WebsiteSetting;
use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamRegistrationController extends Controller
{
    public function index()
    {
        $contest = Contest::where('status', 1)->first();
        $setting = WebsiteSetting::first();
        return view('website.registration.registration', compact('setting', 'contest'));
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
        if ($request->isMethod('get')) {
            return redirect()->route('team.registration');
        }

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

            'coach_photo' => 'nullable',
            'coach_photo_base64' => 'nullable|string',
            'mem_1_photo' => 'nullable',
            'mem_1_photo_base64' => 'nullable|string',
            'mem_2_photo' => 'nullable',
            'mem_2_photo_base64' => 'nullable|string',
            'mem_3_photo' => 'nullable',
            'mem_3_photo_base64' => 'nullable|string',
        ]);

        $uploadedFiles = [];

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $coachPhoto = $this->saveImageFromBase64OrFile($request, 'coach_photo', 'coach');
            if ($coachPhoto) $uploadedFiles[] = $coachPhoto;

            $mem1Photo = $this->saveImageFromBase64OrFile($request, 'mem_1_photo', 'mem1');
            if ($mem1Photo) $uploadedFiles[] = $mem1Photo;

            $mem2Photo = $this->saveImageFromBase64OrFile($request, 'mem_2_photo', 'mem2');
            if ($mem2Photo) $uploadedFiles[] = $mem2Photo;

            $mem3Photo = $this->saveImageFromBase64OrFile($request, 'mem_3_photo', 'mem3');
            if ($mem3Photo) $uploadedFiles[] = $mem3Photo;

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
                'coach_photo' => $coachPhoto,

                // Member 1 Info
                'mem_1_name' => $request->mem_1_name,
                'mem_1_student_id' => $request->mem_1_student_id,
                'mem_1_email' => $request->mem_1_email,
                'mem_1_phone' => $request->mem_1_phone,
                'mem_1_t_shirt' => $request->mem_1_t_shirt,
                'mem_1_photo' => $mem1Photo,

                // Member 2 Info
                'mem_2_name' => $request->mem_2_name,
                'mem_2_student_id' => $request->mem_2_student_id,
                'mem_2_email' => $request->mem_2_email,
                'mem_2_phone' => $request->mem_2_phone,
                'mem_2_t_shirt' => $request->mem_2_t_shirt,
                'mem_2_photo' => $mem2Photo,

                // Member 3 Info
                'mem_3_name' => $request->mem_3_name,
                'mem_3_student_id' => $request->mem_3_student_id,
                'mem_3_email' => $request->mem_3_email,
                'mem_3_phone' => $request->mem_3_phone,
                'mem_3_t_shirt' => $request->mem_3_t_shirt,
                'mem_3_photo' => $mem3Photo,

                'is_paid' => 0,
                'is_selected' => 0,
            ]);

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->route('user.login')->with('success', 'Team Registration Completed Successfully! Please Login.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();

            // Delete uploaded files if database insertion fails
            foreach ($uploadedFiles as $file) {
                if (\Illuminate\Support\Facades\File::exists(public_path($file))) {
                    \Illuminate\Support\Facades\File::delete(public_path($file));
                }
            }

            return redirect()->back()->withInput()->with('error', 'Registration failed due to a server error. Please try again.');
        }
    }

    private function saveImageFromBase64OrFile(Request $request, $fieldName, $prefix)
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
                        if (!\Illuminate\Support\Facades\File::isDirectory($targetDir)) {
                            \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true, true);
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
                if (!\Illuminate\Support\Facades\File::isDirectory($targetDir)) {
                    \Illuminate\Support\Facades\File::makeDirectory($targetDir, 0755, true, true);
                }
                $filename = $prefix . '_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                $file->move($targetDir, $filename);
                return 'uploads/teams/' . $filename;
            }
        }

        return null;
    }
}