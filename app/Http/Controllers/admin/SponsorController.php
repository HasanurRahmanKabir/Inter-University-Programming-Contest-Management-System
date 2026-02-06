<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsor.sponsor', compact('sponsors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sponsor_category' => 'required',
            'details' => 'nullable|string',
            'link' => 'nullable|url'
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/sponsors/';
            $file->move(public_path($path), $filename);
            $logoPath = $path . $filename;
        }

        Sponsor::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'sponsor_category' => $request->sponsor_category,
            'details' => $request->details,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Sponsor added successfully!');
    }
    public function update(Request $request, $sponsor_id)
    {
        $sponsor = Sponsor::findOrFail($sponsor_id);
        $updateData = [
            'name' => $request->name,
            'details' => $request->details,
            'sponsor_category' => $request->sponsor_category,
            'link' => $request->link,
        ];

        if ($request->hasFile('logo')) {

            if (!empty($sponsor->logo) && file_exists(public_path($sponsor->logo))) {
                unlink(public_path($sponsor->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/sponsors/';
            $file->move(public_path($path), $filename);
            $updateData['logo'] = $path . $filename;
        }

        $sponsor->update($updateData);

        return redirect('/admin/dashboard/sponsor')->with('success', 'Sponsor updated successfully');
    }
    public function destroy($id)
    {
        Sponsor::where('sponsor_id', $id)->delete();
        return back()->with('success', 'Sponsor deleted successfully');
    }
}