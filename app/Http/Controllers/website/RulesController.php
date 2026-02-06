<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Rules;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function index(){
        $rules = Rules::all();
        return view('website.rules.rules', compact('rules'));
    }
}
