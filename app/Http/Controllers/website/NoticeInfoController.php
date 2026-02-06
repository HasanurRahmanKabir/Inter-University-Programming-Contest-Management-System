<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;


class NoticeInfoController extends Controller
{
    public function index(){
        $notices = Notice::all();
        return view('website.noticeinfo.notice_info', compact('notices'));
    }
}
