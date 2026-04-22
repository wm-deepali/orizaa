<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeCategoryVideo;

class HomeCategoryVideoController extends Controller
{
    // ================= LIST =================
    public function index()
    {
        $videos = HomeCategoryVideo::orderBy('order')->get();
        return view('admin.home.category_videos', compact('videos'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'video' => 'required|mimes:mp4,mov,avi|max:20480', // 20MB
        ]);

        $videoPath = null;

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('category_videos', 'public');
        }

        HomeCategoryVideo::create([
            'title' => $request->title,
            'video' => $videoPath,
            'link' => $request->link,
            'order' => $request->order ?? 0,
            'status' => 1,
        ]);

        return back()->with('success', 'Video added successfully');
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $video = HomeCategoryVideo::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'video' => 'nullable|mimes:mp4,mov,avi|max:20480',
        ]);

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('category_videos', 'public');
            $video->video = $videoPath;
        }

        $video->update([
            'title' => $request->title,
            'link' => $request->link,
            'order' => $request->order ?? 0,
        ]);

        return back()->with('success', 'Video updated successfully');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $video = HomeCategoryVideo::findOrFail($id);
        $video->delete();

        return back()->with('success', 'Video deleted successfully');
    }
}