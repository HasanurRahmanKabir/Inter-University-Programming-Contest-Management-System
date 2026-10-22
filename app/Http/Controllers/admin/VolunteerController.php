<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VolunteerController extends Controller
{

    public function index()
    {
        $volunteer = Volunteer::paginate(10);
        return view('admin.volunteer.index', compact('volunteer'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteer_infos,email',
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'password' => 'required|string|min:6',
        ], [
            'phone.regex' => 'The phone number may only contain digits (0-9), +, and -.',
        ]);

        $insert = Volunteer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => $request->boolean('status'),
            'volunteer_notice' => $request->volunteernotice,


        ]);

        return redirect()->route('admin.volunteer.index')->with('success', 'Volunteer Added Successfully');
    }
    public function update(Request $request, $volunteer_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteer_infos,email,'.$volunteer_id.',volunteer_id',
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-]+$/'],
            'password' => 'nullable|string|min:6',
        ], [
            'phone.regex' => 'The phone number may only contain digits (0-9), +, and -.',
        ]);

        $volunteer = Volunteer::findOrFail($volunteer_id);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'volunteer_notice' => $request->volunteer_notice,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $volunteer->update($updateData);

        return redirect()->route('admin.volunteer.index')->with('success', 'Volunteer Updated Successfully');
    }
    public function destroy($id)
    {
        Volunteer::where('volunteer_id', $id)->delete();
        return back()->with('success', 'Volunteer Deleted Successfully');
    }
}