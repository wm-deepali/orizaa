<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banners = HomeBanner::latest()->get();
        return view('admin.home.banners', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('home', 'public');

        HomeBanner::create([
            'image' => $path,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Banner added');
    }


    public function update(Request $request, $id)
    {
        $banner = HomeBanner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // delete old image
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $path = $request->file('image')->store('home', 'public');
            $banner->image = $path;
        }

        $banner->link = $request->link;
        $banner->save();

        return redirect()->route('admin.home.banners.index')
            ->with('success', 'Banner updated successfully');
    }

    public function delete($id)
    {
        $HomeBanner = HomeBanner::findOrFail($id);

        if ($HomeBanner->image) {
            Storage::disk('public')->delete($HomeBanner->image);
        }

        $HomeBanner->delete();

        return response()->json([
            'message' => 'Banner Deleted Successfully'
        ]);
    }
}