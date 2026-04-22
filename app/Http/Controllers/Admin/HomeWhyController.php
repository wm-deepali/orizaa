<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeWhy;
use App\Models\HomeWhyCard;
use Illuminate\Support\Facades\Storage;

class HomeWhyController extends Controller
{
    public function index()
    {
        $why = HomeWhy::first();
        $cards = HomeWhyCard::latest()->get();

        return view('admin.home.why', compact('why', 'cards'));
    }

    public function updateSection(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'sub_heading' => 'required',
        ]);

        $why = HomeWhy::first() ?? new HomeWhy();

        $why->heading = $request->heading;
        $why->sub_heading = $request->sub_heading;
        $why->save();

        return back()->with('success', 'Section updated');
    }

    public function storeCard(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'icon' => 'required|image|max:1024',
        ]);

        $path = $request->file('icon')->store('home', 'public');

        HomeWhyCard::create([
            'title' => $request->title,
            'content' => $request->content,
            'icon' => $path,
        ]);

        return back()->with('success', 'Card added');
    }

    // ✅ EDIT (GET DATA)
    public function editCard($id)
    {
        $card = HomeWhyCard::findOrFail($id);
        return response()->json($card);
    }

    // ✅ UPDATE
    public function updateCard(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'icon' => 'nullable|image|max:1024',
        ]);

        $card = HomeWhyCard::findOrFail($id);

        // update image if new uploaded
        if ($request->hasFile('icon')) {

            if ($card->icon) {
                Storage::disk('public')->delete($card->icon);
            }

            $path = $request->file('icon')->store('home', 'public');
            $card->icon = $path;
        }

        $card->title = $request->title;
        $card->content = $request->content;
        $card->save();

        return back()->with('success', 'Card updated successfully');
    }

    public function deleteCard($id)
    {
        $HomeWhyCard = HomeWhyCard::findOrFail($id);

        if ($HomeWhyCard->image) {
            Storage::disk('public')->delete($HomeWhyCard->image);
        }

        $HomeWhyCard->delete();

        return response()->json([
            'message' => 'Card Deleted Successfully'
        ]);
    }
}
