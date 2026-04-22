<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function index()
    {
        $sliders = HomeSlider::latest()->get();
        return view('admin.home.sliders', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('home', 'public');

        HomeSlider::create([
            'image' => $path,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Banner added');
    }


    public function update(Request $request, $id)
    {
        $banner = HomeSlider::findOrFail($id);

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

        return redirect()->route('admin.home.sliders.index')
            ->with('success', 'Banner updated successfully');
    }

    public function delete($id)
    {
        $HomeSlider = HomeSlider::findOrFail($id);

        if ($HomeSlider->image) {
            Storage::disk('public')->delete($HomeSlider->image);
        }

        $HomeSlider->delete();

        return response()->json([
            'message' => 'Banner Deleted Successfully'
        ]);
    }
}