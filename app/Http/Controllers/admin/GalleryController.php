<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('event_date', 'desc')->paginate(12);
        return view('admin.gallery.gallery', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'media_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'event_date' => 'required|date',
        ]);

        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = 'uploads/gallery/';
            $file->move(public_path($path), $filename);

            Gallery::create([
                'media_path' => $path . $filename,
                'media_type' => 'image',
                'event_date' => $request->event_date,
            ]);

            cache()->forget('homepage_galleries');

            return redirect()->back()->with('success', 'Media Uploaded Successfully!');
        }

        return redirect()->back()->with('error', 'Failed to Upload Media.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (File::exists(public_path($gallery->media_path))) {
            File::delete(public_path($gallery->media_path));
        }

        $gallery->delete();

        cache()->forget('homepage_galleries');

        return redirect()->back()->with('success', 'Media Deleted Successfully!');
    }
}