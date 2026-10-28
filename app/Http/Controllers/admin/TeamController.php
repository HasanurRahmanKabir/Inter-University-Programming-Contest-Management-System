<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TeamRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    public function index(Request $request = null)
    {
        $request = $request ?? request();
        $query = TeamRegistration::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('team_name', 'like', '%' . $q . '%')
                    ->orWhere('institute_name', 'like', '%' . $q . '%')
                    ->orWhere('coach_name', 'like', '%' . $q . '%');
            });
        }
        if ($request->filled('filter')) {
            if ($request->filter === '1' || $request->filter === '0') {
                $query->where('is_selected', $request->filter);
            }
        }

        $teamregistration = $query->paginate(10);
        return view('admin.team.index', compact('teamregistration'));
    }

    public function destroy($id)
    {
        $team = TeamRegistration::findOrFail($id);

        // Safeguard: Do not allow deleting a team with an approved payment
        if ($team->is_paid == 1) {
            return back()->with('error', 'Action Denied: Team "' . $team->team_name . '" has an approved payment. Please reject or cancel the payment from the Payments section first.');
        }

        $images = ['coach_photo', 'mem_1_photo', 'mem_2_photo', 'mem_3_photo'];
        foreach ($images as $img) {
            if (!empty($team->$img) && File::exists(public_path($team->$img))) {
                File::delete(public_path($team->$img));
            }
        }

        // Delete associated payment data
        \App\Models\Payment::where('team_name', $team->team_name)->delete();

        $team->delete();
        return back()->with('success', 'Team Deleted Successfully');
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('admin.teamregistration.index');
        }

        $request->validate([
            'team_name' => 'required|string|max:255',
            'institute_name' => 'required|string|max:255',
            'coach_name' => 'required|string|max:255',
            'coach_email' => 'required|email|max:255',
            'coach_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'coach_t_shirt' => 'required|string',
            
            'mem_1_name' => 'required|string|max:255',
            'mem_1_student_id' => 'required|string|max:255',
            'mem_1_email' => 'required|email|max:255',
            'mem_1_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_1_t_shirt' => 'required|string',
            
            'mem_2_name' => 'required|string|max:255',
            'mem_2_student_id' => 'required|string|max:255',
            'mem_2_email' => 'required|email|max:255',
            'mem_2_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_2_t_shirt' => 'required|string',
            
            'mem_3_name' => 'required|string|max:255',
            'mem_3_student_id' => 'required|string|max:255',
            'mem_3_email' => 'required|email|max:255',
            'mem_3_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'mem_3_t_shirt' => 'required|string',
            
            'coach_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,heic,heif|max:2048',
            'mem_1_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,heic,heif|max:2048',
            'mem_2_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,heic,heif|max:2048',
            'mem_3_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,heic,heif|max:2048',
        ], [
            'coach_phone.regex' => 'The emergency contact number may only contain digits (0-9), +, and -.',
            'mem_1_phone.regex' => 'Member 01 contact number may only contain digits (0-9), +, and -.',
            'mem_2_phone.regex' => 'Member 02 contact number may only contain digits (0-9), +, and -.',
            'mem_3_phone.regex' => 'Member 03 contact number may only contain digits (0-9), +, and -.',
        ]);

        $team = TeamRegistration::findOrFail($id);
        $input = $request->except(['coach_photo', 'mem_1_photo', 'mem_2_photo', 'mem_3_photo']);
        if (!$request->has('is_selected')) {
            $input['is_selected'] = 0;
        } else {
            $input['is_selected'] = 1;
        }
        // Handle Coach Photo
        if ($request->hasFile('coach_photo')) {
            if (!empty($team->coach_photo) && File::exists(public_path($team->coach_photo))) {
                File::delete(public_path($team->coach_photo));
            }
            $file = $request->file('coach_photo');
            $filename = 'coach_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['coach_photo'] = 'uploads/teams/' . $filename;
        } elseif ($request->filled('remove_coach_photo') && $request->remove_coach_photo == '1') {
            if (!empty($team->coach_photo) && File::exists(public_path($team->coach_photo))) {
                File::delete(public_path($team->coach_photo));
            }
            $input['coach_photo'] = null;
        }

        // Handle Member 1 Photo
        if ($request->hasFile('mem_1_photo')) {
            if (!empty($team->mem_1_photo) && File::exists(public_path($team->mem_1_photo))) {
                File::delete(public_path($team->mem_1_photo));
            }
            $file = $request->file('mem_1_photo');
            $filename = 'mem1_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['mem_1_photo'] = 'uploads/teams/' . $filename;
        } elseif ($request->filled('remove_mem_1_photo') && $request->remove_mem_1_photo == '1') {
            if (!empty($team->mem_1_photo) && File::exists(public_path($team->mem_1_photo))) {
                File::delete(public_path($team->mem_1_photo));
            }
            $input['mem_1_photo'] = null;
        }

        // Handle Member 2 Photo
        if ($request->hasFile('mem_2_photo')) {
            if (!empty($team->mem_2_photo) && File::exists(public_path($team->mem_2_photo))) {
                File::delete(public_path($team->mem_2_photo));
            }
            $file = $request->file('mem_2_photo');
            $filename = 'mem2_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['mem_2_photo'] = 'uploads/teams/' . $filename;
        } elseif ($request->filled('remove_mem_2_photo') && $request->remove_mem_2_photo == '1') {
            if (!empty($team->mem_2_photo) && File::exists(public_path($team->mem_2_photo))) {
                File::delete(public_path($team->mem_2_photo));
            }
            $input['mem_2_photo'] = null;
        }

        // Handle Member 3 Photo
        if ($request->hasFile('mem_3_photo')) {
            if (!empty($team->mem_3_photo) && File::exists(public_path($team->mem_3_photo))) {
                File::delete(public_path($team->mem_3_photo));
            }
            $file = $request->file('mem_3_photo');
            $filename = 'mem3_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['mem_3_photo'] = 'uploads/teams/' . $filename;
        } elseif ($request->filled('remove_mem_3_photo') && $request->remove_mem_3_photo == '1') {
            if (!empty($team->mem_3_photo) && File::exists(public_path($team->mem_3_photo))) {
                File::delete(public_path($team->mem_3_photo));
            }
            $input['mem_3_photo'] = null;
        }

        $team->update($input);

        return redirect()->route('admin.teamregistration.index')->with('success', 'Team Updated Successfully');
    }
}