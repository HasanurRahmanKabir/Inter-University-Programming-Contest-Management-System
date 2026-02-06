<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rules;
use Illuminate\Http\Request;

class RulesAdminController extends Controller
{
    public function index()
    {
        $rules = Rules::all();
        return view('admin.rulesadmin.rules_admin', compact('rules'));
    }
    public function store(Request $request)
    {
        $insert = Rules::create([
            'rules_id' => $request->rules_id,
            'rules_headline' => $request->rules_headline,
            'rules_description' => $request->rules_description,
            'is_published' => $request->input('is_published', 1),


        ]);

        return redirect('/admin/dashboard/rules_admin')->with('success', 'rules added successfully');
    }
    public function update(Request $request, $rules_id)
    {
        $updates = Rules::findOrFail($rules_id);
        $updates->update([
            'rules_headline' => $request->rules_headline,
            'rules_description' => $request->rules_description,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        return redirect('admin/dashboard/rules_admin')->with('success', 'Rules updated successfully');
    }
    public function destroy($id)
    {
        Rules::where('rules_id', $id)->delete();
        return back()->with('success', 'Rules deleted successfully');
    }
}
