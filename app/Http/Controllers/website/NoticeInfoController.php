<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\WebsiteSetting;
use App\Models\Contest;

class NoticeInfoController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        $setting = WebsiteSetting::first();
        $contest = Contest::where('status', 1)->first();
        $today = date('Y-m-d');
        $isRegistrationOpen = false;

        if ($contest && $contest->status == 1 && $today >= $contest->registration_start_date && $today <= $contest->registration_end_date) {
            $isRegistrationOpen = true;
        }

        return view('website.noticeinfo.notice_info', compact('notices', 'isRegistrationOpen', 'setting', 'contest'));
    }
}