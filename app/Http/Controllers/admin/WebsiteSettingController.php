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
        $data = $request->except(['header_logo', 'footer_logo', 'hero_banner', 'about_image', 'delete_images']);
        $images = ['header_logo', 'footer_logo', 'hero_banner', 'about_image'];

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

        return back()->with('success', 'Website Settings Updated Successfully!');
    }

    public function destroy()
    {
        $setting = WebsiteSetting::first();
        if ($setting) {
            $images = ['header_logo', 'footer_logo', 'hero_banner', 'about_image'];
            foreach ($images as $img) {
                if (!empty($setting->$img) && File::exists(public_path($setting->$img))) {
                    File::delete(public_path($setting->$img));
                }
            }
            $setting->delete();
            return back()->with('success', 'Settings Reset Successfully!');
        }
        return back()->with('error', 'No Settings Found to Delete.');
    }
    public function deleteImage($field)
    {
        $setting = WebsiteSetting::first();
        $allowedFields = ['header_logo', 'footer_logo', 'hero_banner', 'about_image'];

        if ($setting && in_array($field, $allowedFields) && !empty($setting->$field)) {
            if (File::exists(public_path($setting->$field))) {
                File::delete(public_path($setting->$field));
            }

            $setting->$field = null;
            $setting->save();

            return back()->with('success', 'Image Removed Successfully!');
        }

        return back()->with('error', 'Image Not Found.');
    }
}