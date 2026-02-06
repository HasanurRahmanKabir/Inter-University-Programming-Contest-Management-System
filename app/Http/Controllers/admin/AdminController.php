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

        $insert = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->pass),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('admin/dashboard/admin')->with('success', 'admin added successfully');
    }
    public function update(Request $request, $admin_id)
    {
        $admin = Admin::findOrFail($admin_id);
        $admin->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);
        
        return redirect('admin/dashboard/admin')->with('success', 'Admin updated successfully');
    }
    public function destroy($id)
    {
        Admin::where('admin_id', $id)->delete();
        return back()->with('success', 'Admin deleted successfully');
    }

}
