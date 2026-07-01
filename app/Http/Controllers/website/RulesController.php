<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Rules;
use App\Models\Contest; 
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function index()
    {
        $rules = Rules::all();
        $contest = Contest::first(); 
        $setting = WebsiteSetting::first();
        $today = date('Y-m-d');
        $isRegistrationOpen = false;

        if ($contest && $contest->status == 1 && $today >= $contest->registration_start_date && $today <= $contest->registration_end_date) {
            $isRegistrationOpen = true;
        }

        return view('website.rules.rules', compact('rules', 'isRegistrationOpen', 'setting'));
    }
}