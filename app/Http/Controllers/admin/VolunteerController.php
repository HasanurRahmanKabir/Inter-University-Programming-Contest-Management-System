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
        $volunteer = Volunteer::all();
        return view('admin.Volunteer.volunteer', compact('volunteer'));
    }
    public function store(Request $request)
    {
        $insert = Volunteer::create([
            'volunteer_id' => $request->volunteerid,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => $request->boolean('status'),
            'volunteer_notice' => $request->volunteernotice,


        ]);

        return redirect('admin/dashboard/volunteer')->with('success', 'volunteer added successfully');
    }
    public function update(Request $request, $volunteer_id)
    {
        $volunteer = Volunteer::findOrFail($volunteer_id);
        $volunteer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'volunteer_notice' => $request->volunteer_notice,
        ]);

        return redirect('admin/dashboard/volunteer')->with('success', 'Volunteer updated successfully');
    }
    public function destroy($id)
    {
        Volunteer::where('volunteer_id', $id)->delete();
        return back()->with('success', 'Volunteer deleted successfully');
    }
}