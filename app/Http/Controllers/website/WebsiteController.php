<?php

namespace App\Http\Controllers\website;

use App\Models\Gallery;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\Notice;
use App\Models\Sponsor;
use App\Models\TeamRegistration;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    public function index()
    {
        // Cache heavy queries for 24 hours (86400 seconds)
        $notice = Cache::remember('homepage_notices', 86400, function () {
            return Notice::where('status', 1)->orderBy('created_at', 'desc')->take(4)->get();
        });

        $sponsors = Cache::remember('homepage_sponsors', 86400, function () {
            return Sponsor::where('status', 1)->get();
        });

        $contest = Cache::remember('homepage_contest_latest', 86400, function () {
            return Contest::orderBy('created_at', 'desc')->take(1)->get();
        });

        $contestinfo = Cache::remember('homepage_contest_info', 86400, function () {
            return Contest::where('status', 1)->first();
        });

        $galleries = Cache::remember('homepage_galleries', 86400, function () {
            return Gallery::latest()->get();
        });

        $setting = Cache::remember('homepage_settings', 86400, function () {
            return WebsiteSetting::first();
        });

        // Team count can change dynamically, so we cache it for 5 minutes only (300 seconds)
        $teamcount = Cache::remember('homepage_teamcount', 300, function () {
            return TeamRegistration::count();
        });

        $today = Carbon::today();
        $isRegistrationOpen = false;

        if ($contestinfo) {
            $startDate = Carbon::parse($contestinfo->registration_start_date);
            $endDate = Carbon::parse($contestinfo->registration_end_date);

            if ($today->between($startDate, $endDate)) {
                $isRegistrationOpen = true;
            }
        }

        return view('website.home_page.index', compact('notice', 'sponsors', 'contest', 'teamcount', 'isRegistrationOpen', 'galleries', 'setting'));
    }
}
