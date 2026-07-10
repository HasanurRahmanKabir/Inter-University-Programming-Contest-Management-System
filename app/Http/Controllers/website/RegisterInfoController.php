<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Models\Contest;
use App\Models\TeamRegistration;


class RegisterInfoController extends Controller
{
    public function index(){
        $teams = TeamRegistration::all();
        $setting = WebsiteSetting::first();
        $contest = Contest::where('status', 1)->first();
        return view('website.registrationinfo.registration_info', compact('teams', 'setting', 'contest'));
    }
}
