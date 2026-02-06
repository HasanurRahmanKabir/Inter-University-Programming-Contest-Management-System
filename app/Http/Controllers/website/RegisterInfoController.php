<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamRegistration;


class RegisterInfoController extends Controller
{
    public function index(){
        $teams = TeamRegistration::all();
        return view('website.registrationinfo.registration_info', compact('teams'));
    }
}
