<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        return view('admin.website_settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        
        // সব রিকোয়েস্ট ডাটা $data এ নিচ্ছি
        $data = $request->except(['header_logo', 'footer_logo', 'hero_banner', 'about_image']);

        $images = ['header_logo', 'footer_logo', 'hero_banner', 'about_image'];
        
        foreach ($images as $img) {
            if ($request->hasFile($img)) {
                // ১. পুরাতন ফাইল ডিলিট (পুরানো পাথে ফাইল থাকলে ডিলিট করবে)
                if (!empty($setting->$img) && File::exists(public_path($setting->$img))) {
                    File::delete(public_path($setting->$img));
                }
                
                // ২. নতুন ফাইল আপলোড
                $file = $request->file($img);
                $filename = $img . '_' . time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'uploads/settings';
                
                // ৩. ফোল্ডার না থাকলে তৈরি করা
                if (!File::exists(public_path($destinationPath))) {
                    File::makeDirectory(public_path($destinationPath), 0777, true, true);
                }
                
                // ৪. ফাইল মুভ করা
                $file->move(public_path($destinationPath), $filename);
                
                // ৫. ডাটাবেসে পাথ সেভ করা
                $data[$img] = $destinationPath . '/' . $filename;
            }
        }

        // ৬. ডাটাবেসে সেভ করা
        $setting->fill($data)->save();
        
        return back()->with('success', 'Website settings updated successfully!');
    }

    public function destroy()
    {
        $setting = WebsiteSetting::first();
        if ($setting) {
            // ডাটা ডিলিট করার আগে ইমেজ ফাইলগুলোও সার্ভার থেকে মুছে দেওয়া ভালো
            $images = ['header_logo', 'footer_logo', 'hero_banner', 'about_image'];
            foreach($images as $img) {
                if (!empty($setting->$img) && File::exists(public_path($setting->$img))) {
                    File::delete(public_path($setting->$img));
                }
            }
            $setting->delete();
            return back()->with('success', 'Settings reset successfully!');
        }
        return back()->with('error', 'No settings found to delete.');
    }
}