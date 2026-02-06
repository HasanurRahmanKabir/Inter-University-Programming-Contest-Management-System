<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index(Request $request = null)
    {
        $request = $request ?? request();
        $query = Notice::query();

        if ($request->has('audience')) {
            $aud = trim((string) $request->audience);
            if ($aud !== '') {
                $query->where('audience', $aud);
            }
        }

        if ($request->filled('status')) {
            if ($request->status === '1' || $request->status === '0') {
                $query->where('status', $request->status);
            }
        }

        $notice = $query->orderBy('notice_date', 'desc')->paginate(10)->withQueryString();
        return view('admin.notice.notice', compact('notice'));
    }

    public function store(Request $request)
    {
        $insert = Notice::create([
            'notice_id' => $request->noticeid,
            'title' => $request->title,
            'description' => $request->description,
            'audience' => $request->audience,
            'notice_date' => $request->notice_date,
            'status' => $request->boolean('status'),


        ]);

        return redirect('admin/dashboard/notice')->with('success', 'notice added successfully');
    }
    public function update(Request $request, $notice_id)
    {
        $notice = Notice::findOrFail($notice_id);
        $notice->update([
            'title' => $request->title,
            'description' => $request->description,
            'audience' => $request->audience,
            'notice_date' => $request->notice_date,
            'status' => $request->status,
        ]);

        return redirect('admin/dashboard/notice')->with('success', 'Notice updated successfully');
    }
    public function destroy($id)
    {
        Notice::where('notice_id', $id)->delete();
        return back()->with('success', 'Notice deleted successfully');
    }
}
