<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('admin.user.all_user', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin_infos,email',
            'phone' => 'nullable|string|max:20',
            'pass' => 'required|min:6',
            'role' => 'required|in:0,1',
            'status' => 'required|in:0,1',
        ]);

        $insert = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->pass),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('admin/dashboard/admin')->with('success', 'Admin Added Successfully');
    }

    public function update(Request $request, $admin_id)
    {
        $admin = Admin::findOrFail($admin_id);
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admin_infos,email,' . $admin_id . ',admin_id',
            'phone' => 'nullable|string|max:20',
            'pass' => 'nullable|min:6',
            'status' => 'required|in:0,1',
        ]);

        $updateData = [
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ];

        if ($request->filled('pass')) {
            $updateData['password'] = bcrypt($request->pass);
        }

        $admin->update($updateData);
        return redirect('admin/dashboard/admin')->with('success', 'Admin Updated Successfully');
    }
    public function destroy($id)
    {
        Admin::where('admin_id', $id)->delete();
        return back()->with('success', 'Admin Deleted Successfully');
    }

}
