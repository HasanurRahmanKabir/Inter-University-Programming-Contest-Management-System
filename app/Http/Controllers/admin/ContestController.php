<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function index()
    {
        $contest = Contest::all();
        return view('admin.contest.contest', compact('contest'));
    }
    public function store(Request $request)
    {
        $insert = Contest::create([
            'contest_id' => $request->contest_id,
            'title' => $request->title,
            'description' => $request->description,
            'contest_start_date' => $request->contest_start_date,
            'contest_end_date' => $request->contest_end_date,
            'registration_start_date' => $request->registration_start_date,
            'registration_end_date' => $request->registration_end_date,
            'status' => $request->boolean('status'),

        ]);

        return redirect('admin/dashboard/contest')->with('success', 'contest added successfully');
    }
    public function update(Request $request, $contest_id)
    {
        $contest = Contest::findOrFail($contest_id);
        $contest->update([
            'title' => $request->title,
            'description' => $request->description,
            'contest_start_date' => $request->contest_start_date,
            'contest_end_date' => $request->contest_end_date,
            'registration_start_date' => $request->registration_start_date,
            'registration_end_date' => $request->registration_end_date,
            'status' => $request->status,
        ]);

        return redirect('admin/dashboard/contest')->with('success', 'Contest updated successfully');
    }


    public function destroy($id)
    {
        Contest::where('contest_id', $id)->delete();
        return back()->with('success', 'Contest deleted successfully');
    }

}
