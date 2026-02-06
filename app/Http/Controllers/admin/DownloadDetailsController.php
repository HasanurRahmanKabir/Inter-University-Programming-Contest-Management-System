<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TeamRegistration;
use Illuminate\Http\Request;

class DownloadDetailsController extends Controller
{
    public function index()
    {

        $details = TeamRegistration::all();

        return view('admin.downloaddetails.downloaddetails', compact('details'));
    }
    public function show($id)
    {
        $views = TeamRegistration::findOrFail($id);
        return view('admin.downloaddetails.viewteam', compact('views'));
    }
}