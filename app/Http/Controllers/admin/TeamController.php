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

        $teamregistration = $query->get();
        return view('admin.Team.team', compact('teamregistration'));
    }

    public function destroy($id)
    {
        $team = TeamRegistration::findOrFail($id);
        $images = ['coach_photo', 'mem_1_photo', 'mem_2_photo', 'mem_3_photo'];
        foreach ($images as $img) {
            if (!empty($team->$img) && File::exists(public_path($team->$img))) {
                File::delete(public_path($team->$img));
            }
        }

        $team->delete();
        return back()->with('success', 'Team deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $team = TeamRegistration::findOrFail($id);
        $input = $request->except(['coach_photo', 'mem_1_photo', 'mem_2_photo', 'mem_3_photo']);
        if (!$request->has('is_selected')) {
            $input['is_selected'] = 0;
        } else {
            $input['is_selected'] = 1;
        }
        if ($request->hasFile('coach_photo')) {
            if (!empty($team->coach_photo) && File::exists(public_path($team->coach_photo))) {
                File::delete(public_path($team->coach_photo));
            }
            $file = $request->file('coach_photo');
            $filename = 'coach_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['coach_photo'] = 'uploads/teams/' . $filename;
        }
        if ($request->hasFile('mem_1_photo')) {
            if (!empty($team->mem_1_photo) && File::exists(public_path($team->mem_1_photo))) {
                File::delete(public_path($team->mem_1_photo));
            }
            $file = $request->file('mem_1_photo');
            $filename = 'mem1_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['mem_1_photo'] = 'uploads/teams/' . $filename;
        }
        if ($request->hasFile('mem_2_photo')) {
            if (!empty($team->mem_2_photo) && File::exists(public_path($team->mem_2_photo))) {
                File::delete(public_path($team->mem_2_photo));
            }
            $file = $request->file('mem_2_photo');
            $filename = 'mem2_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['mem_2_photo'] = 'uploads/teams/' . $filename;
        }

        if ($request->hasFile('mem_3_photo')) {
            if (!empty($team->mem_3_photo) && File::exists(public_path($team->mem_3_photo))) {
                File::delete(public_path($team->mem_3_photo));
            }
            $file = $request->file('mem_3_photo');
            $filename = 'mem3_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teams/'), $filename);
            $input['mem_3_photo'] = 'uploads/teams/' . $filename;
        }

        $team->update($input);

        return redirect()->back()->with('success', 'Team updated successfully');
    }
}