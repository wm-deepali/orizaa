<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiftingOccasion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GiftingOccasionController extends Controller
{
    public function index()
    {
        $occasions = GiftingOccasion::latest()->paginate(10);
        return view('admin.gifting_occasions.index', compact('occasions'));
    }

    public function create()
    {
        return view('admin.gifting_occasions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('gifting', 'public');
        }

        GiftingOccasion::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'short_description' => $request->short_description,
            'slug' => Str::slug($request->title),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'image' => $image,
            'status' => $request->status ?? 1,
        ]);

        return back()->with('success', 'Occasion Added Successfully');
    }

    public function edit($id)
    {
        $occasion = GiftingOccasion::findOrFail($id);
        return view('admin.gifting_occasions.edit', compact('occasion'));
    }

    public function update(Request $request, $id)
    {
        $occasion = GiftingOccasion::findOrFail($id);

        $request->validate([
            'title' => 'required'
        ]);

        $image = $occasion->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($occasion->image && Storage::disk('public')->exists($occasion->image)) {
                Storage::disk('public')->delete($occasion->image);
            }

            // store new
            $image = $request->file('image')->store('gifting', 'public');
        }

        $occasion->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'short_description' => $request->short_description,
            'slug' => Str::slug($request->title),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ?? 1,
            'image' => $image,
        ]);

        return redirect()->route('admin.gifting-occasions.index')
            ->with('success', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $occasion = GiftingOccasion::findOrFail($id);

        // delete image from storage
        if ($occasion->image && Storage::disk('public')->exists($occasion->image)) {
            Storage::disk('public')->delete($occasion->image);
        }

        $occasion->delete();

        return response()->json([
            'message' => 'Deleted Successfully'
        ]);
    }
}