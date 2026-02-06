<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\KitStatus;
use App\Models\TeamRegistration;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $teamregistration = TeamRegistration::orderBy('created_at', 'desc')->take(5)->get();
        $totalTeams = TeamRegistration::count();
        $pendingPayments = TeamRegistration::where('is_paid', 0)->count();
        $activeContest = Contest::where('status', 1)->first();
        $kitsDistributed = KitStatus::where('kit_received', 1)->count();

        return view('admin.dashboard.index', compact(
            'teamregistration',
            'totalTeams',
            'pendingPayments',
            'activeContest',
            'kitsDistributed',
        ));
    }
}
