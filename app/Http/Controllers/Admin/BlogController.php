<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }


    public function create()
    {
        return view('admin.blogs.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $slug = Str::slug($request->title);

        if (empty($slug)) {
            $slug = str_replace(' ', '-', $request->title);
        }

        $imageName = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();

            $imageName = $file->storeAs('blogs', $filename, 'public');
        }


        Blog::create([

            'title' => $request->title,

            'slug' => $slug,

            'image' => $imageName,

            'short_description' => $request->short_description,

            'content' => $request->content,

            'show_home' => $request->show_home ? 1 : 0,

            'status' => $request->status ? 1 : 0

        ]);


        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog Added Successfully');

    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.edit', compact('blog'));
    }


    public function update(Request $request, $id)
    {

        $blog = Blog::findOrFail($id);

        $slug = Str::slug($request->title);

        if (empty($slug)) {
            $slug = str_replace(' ', '-', $request->title);
        }

        $imageName = $blog->image;

        if ($request->hasFile('image')) {

            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $file = $request->file('image');

            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->extension();

            $imageName = $file->storeAs('blogs', $filename, 'public');
        }


        $blog->update([

            'title' => $request->title,

            'slug' => $slug,

            'image' => $imageName,

            'short_description' => $request->short_description,

            'content' => $request->content,

            'show_home' => $request->show_home ? 1 : 0,

            'status' => $request->status ? 1 : 0

        ]);


        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog Updated Successfully');

    }


    public function destroy($id)
    {

        $blog = Blog::findOrFail($id);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return response()->json([
            'message' => 'Blog Deleted Successfully'
        ]);

    }

}