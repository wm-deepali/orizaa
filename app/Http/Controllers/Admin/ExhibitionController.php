<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exhibition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExhibitionController extends Controller
{
    public function index()
    {
        $exhibitions = Exhibition::latest()->get();
        return view('admin.exhibitions.index', compact('exhibitions'));
    }

    public function create()
    {
        return view('admin.exhibitions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:exhibitions,slug',
            'venue' => 'nullable|string|max:255',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $imageName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $slug . '-' . time() . '.' . $file->extension();
            $imageName = $file->storeAs('exhibitions', $filename, 'public');
        }

        Exhibition::create([
            'title' => $request->title,
            'slug' => $slug,
            'venue' => $request->venue,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'subtitle' => $request->subtitle,
            'image' => $imageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('admin.exhibitions.index')
            ->with('success', 'Exhibition Added Successfully');
    }

    public function edit($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        return view('admin.exhibitions.edit', compact('exhibition'));
    }

    public function update(Request $request, $id)
    {
        $exhibition = Exhibition::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:exhibitions,slug,' . $id,
            'venue' => 'nullable|string|max:255',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $imageName = $exhibition->image;

        if ($request->hasFile('image')) {

            if ($exhibition->image) {
                Storage::disk('public')->delete($exhibition->image);
            }

            $file = $request->file('image');
            $filename = $slug . '-' . time() . '.' . $file->extension();
            $imageName = $file->storeAs('exhibitions', $filename, 'public');
        }

        $exhibition->update([
            'title' => $request->title,
            'slug' => $slug,
            'venue' => $request->venue,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'subtitle' => $request->subtitle,
            'image' => $imageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('admin.exhibitions.index')
            ->with('success', 'Exhibition Updated Successfully');
    }

    public function destroy($id)
    {
        $exhibition = Exhibition::findOrFail($id);

        if ($exhibition->image) {
            Storage::disk('public')->delete($exhibition->image);
        }

        $exhibition->delete();

        return response()->json([
            'message' => 'Exhibition Deleted Successfully'
        ]);
    }
}