<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        return view('admin.website-settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website_name' => 'nullable|string|max:150',
            'hero_title' => 'nullable|string|max:200',
            'about_title' => 'nullable|string|max:200',
            'hero_description' => 'nullable|string|max:1500',
            'about_description' => 'nullable|string|max:2000',
            'event_schedule_title_1' => 'nullable|string|max:150',
            'event_schedule_description_1' => 'nullable|string|max:1000',
            'event_schedule_title_2' => 'nullable|string|max:150',
            'event_schedule_description_2' => 'nullable|string|max:1000',
            'prize_pool_amount' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'footer_description' => 'nullable|string|max:1000',
            'copyright_text' => 'nullable|string|max:255',
            'platform_1_name' => 'nullable|string|max:100',
            'platform_2_name' => 'nullable|string|max:100',
            'platform_3_name' => 'nullable|string|max:100',
            'platform_4_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone_number' => ['nullable', 'regex:/^[0-9+\-\s()]{6,25}$/'],
            'facebook_link' => 'nullable|url|max:500',
            'youtube_link' => 'nullable|url|max:500',
            'linkedin_link' => 'nullable|url|max:500',
            'platform_1_link' => 'nullable|url|max:500',
            'platform_2_link' => 'nullable|url|max:500',
            'platform_3_link' => 'nullable|url|max:500',
            'platform_4_link' => 'nullable|url|max:500',
            'website_favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,webp,svg|max:1024',
            'admin_favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,webp,svg|max:1024',
            'coach_favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,webp,svg|max:1024',
            'volunteer_favicon' => 'nullable|file|mimes:ico,png,jpg,jpeg,webp,svg|max:1024',
            'header_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'hero_banner' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'about_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:3072',
        ], [
            'phone_number.regex' => 'The phone number format is invalid. Only digits (0-9), +, and - are allowed.',
            'email.email' => 'Please enter a valid email address.',
            'facebook_link.url' => 'The Facebook URL must be a valid URL starting with http:// or https://',
            'youtube_link.url' => 'The YouTube URL must be a valid URL starting with http:// or https://',
            'linkedin_link.url' => 'The LinkedIn URL must be a valid URL starting with http:// or https://',
            'platform_1_link.url' => 'Platform 1 Link must be a valid URL starting with http:// or https://',
            'platform_2_link.url' => 'Platform 2 Link must be a valid URL starting with http:// or https://',
            'platform_3_link.url' => 'Platform 3 Link must be a valid URL starting with http:// or https://',
            'platform_4_link.url' => 'Platform 4 Link must be a valid URL starting with http:// or https://',
            'website_favicon.mimes' => 'Website Favicon must be a valid icon/image file (.ico, .png, .jpg, .jpeg, .webp, .svg). Executable, script, zip, doc or video files are strictly forbidden.',
            'admin_favicon.mimes' => 'Admin Favicon must be a valid icon/image file (.ico, .png, .jpg, .jpeg, .webp, .svg).',
            'coach_favicon.mimes' => 'Coach Favicon must be a valid icon/image file (.ico, .png, .jpg, .jpeg, .webp, .svg).',
            'volunteer_favicon.mimes' => 'Volunteer Favicon must be a valid icon/image file (.ico, .png, .jpg, .jpeg, .webp, .svg).',
            'header_logo.image' => 'Header Logo must be a valid image file. Documents, scripts, archives, or videos are not allowed.',
            'header_logo.mimes' => 'Header Logo must be of type: png, jpg, jpeg, webp, svg.',
            'footer_logo.image' => 'Footer Logo must be a valid image file. Documents, scripts, archives, or videos are not allowed.',
            'footer_logo.mimes' => 'Footer Logo must be of type: png, jpg, jpeg, webp, svg.',
            'hero_banner.image' => 'Hero Banner must be a valid image file. Documents, scripts, archives, or videos are not allowed.',
            'hero_banner.mimes' => 'Hero Banner must be of type: png, jpg, jpeg, webp.',
            'about_image.image' => 'About Us Image must be a valid image file. Documents, scripts, archives, or videos are not allowed.',
            'about_image.mimes' => 'About Us Image must be of type: png, jpg, jpeg, webp.',
        ]);

        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        $data = $request->except(['favicon', 'website_favicon', 'admin_favicon', 'coach_favicon', 'volunteer_favicon', 'header_logo', 'footer_logo', 'hero_banner', 'about_image', 'delete_images']);
        $images = ['website_favicon', 'admin_favicon', 'coach_favicon', 'volunteer_favicon', 'header_logo', 'footer_logo', 'hero_banner', 'about_image'];

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $del_img) {
                if (in_array($del_img, $images)) {
                    if (!empty($setting->$del_img) && File::exists(public_path($setting->$del_img))) {
                        File::delete(public_path($setting->$del_img));
                    }
                    $data[$del_img] = null;
                }
            }
        }

        foreach ($images as $img) {
            if ($request->hasFile($img)) {
                if (!empty($setting->$img) && File::exists(public_path($setting->$img))) {
                    File::delete(public_path($setting->$img));
                }

                $file = $request->file($img);
                $filename = $img . '_' . time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = 'uploads/settings';

                if (!File::exists(public_path($destinationPath))) {
                    File::makeDirectory(public_path($destinationPath), 0777, true, true);
                }

                $file->move(public_path($destinationPath), $filename);
                $data[$img] = $destinationPath . '/' . $filename;
            }
        }

        $setting->fill($data)->save();

        cache()->forget('homepage_settings');

        return back()->with('success', 'Website Settings Updated Successfully!');
    }

    public function destroy()
    {
        $setting = WebsiteSetting::first();
        if ($setting) {
            $images = ['website_favicon', 'admin_favicon', 'coach_favicon', 'volunteer_favicon', 'header_logo', 'footer_logo', 'hero_banner', 'about_image'];
            foreach ($images as $img) {
                if (!empty($setting->$img) && File::exists(public_path($setting->$img))) {
                    File::delete(public_path($setting->$img));
                }
            }
            $setting->delete();
            
            cache()->forget('homepage_settings');
            
            return back()->with('success', 'Settings Reset Successfully!');
        }
        return back()->with('error', 'No Settings Found to Delete.');
    }
    public function deleteImage($field)
    {
        $setting = WebsiteSetting::first();
        $allowedFields = ['website_favicon', 'admin_favicon', 'coach_favicon', 'volunteer_favicon', 'header_logo', 'footer_logo', 'hero_banner', 'about_image'];

        if ($setting && in_array($field, $allowedFields) && !empty($setting->$field)) {
            if (File::exists(public_path($setting->$field))) {
                File::delete(public_path($setting->$field));
            }

            $setting->$field = null;
            $setting->save();

            cache()->forget('homepage_settings');

            return back()->with('success', 'Image Removed Successfully!');
        }

        return back()->with('error', 'Image Not Found.');
    }
}