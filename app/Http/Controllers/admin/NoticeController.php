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

        if ($request->has('search') && $request->search !== null) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

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
        $request->validate([
            'title' => 'required|string|max:255',
            'audience' => 'required|string',
            'notice_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $insert = Notice::create([
            'title' => $request->title,
            'description' => $request->description,
            'audience' => $request->audience,
            'notice_date' => $request->notice_date,
            'status' => $request->boolean('status'),
        ]);

        cache()->forget('homepage_notices');

        return redirect('admin/dashboard/notice')->with('success', 'Notice Added Successfully');
    }
    public function update(Request $request, $notice_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'audience' => 'required|string',
            'notice_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $notice = Notice::findOrFail($notice_id);
        $notice->update([
            'title' => $request->title,
            'description' => $request->description,
            'audience' => $request->audience,
            'notice_date' => $request->notice_date,
            'status' => $request->status,
        ]);

        cache()->forget('homepage_notices');

        return redirect('admin/dashboard/notice')->with('success', 'Notice Updated Successfully');
    }
    public function destroy($id)
    {
        Notice::where('notice_id', $id)->delete();
        cache()->forget('homepage_notices');
        return back()->with('success', 'Notice Deleted Successfully');
    }
}
