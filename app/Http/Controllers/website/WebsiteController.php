<?php

namespace App\Http\Controllers\website;

use App\Models\Gallery;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\Notice;
use App\Models\Sponsor;
use App\Models\TeamRegistration;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $notice = Notice::orderBy('created_at', 'desc')->take(4)->get();
        $sponsors = Sponsor::all();
        $contest = Contest::orderBy('created_at', 'desc')->take(1)->get();
        $teamcount = TeamRegistration::count();
        $contestinfo = Contest::where('status', 1)->first();
        $galleries = Gallery::latest()->get();

        $today = Carbon::today();

        $isRegistrationOpen = false;

        if ($contestinfo) {
            $startDate = Carbon::parse($contestinfo->registration_start_date);
            $endDate = Carbon::parse($contestinfo->registration_end_date);

            if ($today->between($startDate, $endDate)) {
                $isRegistrationOpen = true;
            }
        }

        return view('website.home_page.index', compact('notice', 'sponsors', 'contest', 'teamcount', 'isRegistrationOpen', 'galleries'));
    }
}
