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
        $request->validate([
            'rules_headline' => 'required|string|max:255',
            'rules_description' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        Rules::create([
            'rules_headline' => $request->rules_headline,
            'rules_description' => $request->rules_description,
            'is_published' => $request->input('is_published', 1),
        ]);

        return redirect('/admin/dashboard/rules_admin')->with('success', 'Rules Added Successfully');
    }

    public function update(Request $request, $rules_id)
    {
        $request->validate([
            'rules_headline' => 'required|string|max:255',
            'rules_description' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        $rule = Rules::findOrFail($rules_id);
        $rule->update([
            'rules_headline' => $request->rules_headline,
            'rules_description' => $request->rules_description,
            'is_published' => $request->is_published, 
        ]);

        return redirect('admin/dashboard/rules_admin')->with('success', 'Rules Updated Successfully');
    }

    public function destroy($id)
    {
        Rules::where('rules_id', $id)->delete();
        return back()->with('success', 'Rules Deleted Successfully');
    }
}