<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeFeatureCard;

class HomeFeatureController extends Controller
{
    public function index()
    {
        $cards = HomeFeatureCard::latest()->get();
        return view('admin.home.features', compact('cards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('home', 'public');

        HomeFeatureCard::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'image' => $path,
            'button_text' => $request->button_text,
            'link' => $request->link,
        ]);

        return back()->with('success', 'Card added');
    }

    public function update(Request $request, $id)
    {
        $card = HomeFeatureCard::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {

            // delete old image
            if ($card->image) {
                \Storage::disk('public')->delete($card->image);
            }

            $path = $request->file('image')->store('home', 'public');
            $card->image = $path;
        }

        $card->title = $request->title;
        $card->sub_title = $request->sub_title;
        $card->button_text = $request->button_text;
        $card->link = $request->link;

        $card->save();

        return back()->with('success', 'Card updated successfully');
    }

    public function delete($id)
    {
        HomeFeatureCard::findOrFail($id)->delete();
        return back()->with('success', 'Deleted');
    }
}