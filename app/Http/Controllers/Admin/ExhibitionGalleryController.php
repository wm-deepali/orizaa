<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\ExhibitionGallery;
use Illuminate\Support\Facades\Storage;

class ExhibitionGalleryController extends Controller
{
    public function index($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $images = $exhibition->galleries;

        return view('admin.exhibitions.gallery', compact('exhibition', 'images'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'images.*' => 'required|image'
        ]);

        foreach ($request->file('images') as $file) {

            $filename = time() . '-' . rand(111,999) . '.' . $file->extension();

            $path = $file->storeAs('exhibition-gallery', $filename, 'public');

            ExhibitionGallery::create([
                'exhibition_id' => $id,
                'image' => $path
            ]);
        }

        return back()->with('success', 'Images Uploaded Successfully');
    }

    public function destroy($id)
    {
        $image = ExhibitionGallery::findOrFail($id);

        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json([
            'message' => 'Image Deleted Successfully'
        ]);
    }
}