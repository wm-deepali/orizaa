<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class UserController extends Controller
{

    public function dashboard()
    {
        $userId = auth('customer')->id();

        $orders = Order::with(['items'])
            ->where('user_id', auth('customer')->id())
            ->latest()
            ->get();

        $addresses = Address::with(['city', 'state'])
            ->where('user_id', auth('customer')->id())
            ->get();

        $reviews = Review::with(['product', 'user'])
            ->where('user_id', auth('customer')->id())
            ->latest()
            ->get();


        // ✅ ADD THIS
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('front-pages.dashboard', compact(
            'orders',
            'addresses',
            'reviews',
            'wishlistItems'
        ));
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $user = auth('customer')->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'address' => $request->address,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'pincode' => $request->pincode,
        ]);

        return back()->with('success', 'Profile updated successfully');
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $isFirst = Address::where('user_id', auth('customer')->id())->count() == 0;

        Address::create([
            'user_id' => auth('customer')->id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city_id' => $request->city,
            'state_id' => $request->state,
            'pincode' => $request->pincode,
            'is_default' => $isFirst ? 1 : 0
        ]);

        return back()->with('success', 'Address added successfully');
    }

    public function setDefaultAddress($id)
    {
        Address::where('user_id', auth('customer')->id())
            ->update(['is_default' => 0]);

        Address::where('id', $id)
            ->update(['is_default' => 1]);

        return back();
    }

    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $address = Address::where('id', $id)
            ->where('user_id', auth('customer')->id())
            ->firstOrFail();

        $address->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city_id' => $request->city,
            'state_id' => $request->state,
            'pincode' => $request->pincode,
        ]);

        return back()->with('success', 'Address updated');
    }

    public function deleteAddress($id)
    {
        Address::where('id', $id)
            ->where('user_id', auth('customer')->id())
            ->delete();

        return back();
    }


    public function storeReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);


        $userId = auth('customer')->id();

        // ✅ check already reviewed
        $exists = Review::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already reviewed this product');
        }

        // ✅ OPTIONAL: check if product purchased
        $purchased = \App\Models\OrderItem::whereHas('order', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('product_id', $request->product_id)
            ->exists();

        if (!$purchased) {
            return back()->with('error', 'You can only review purchased products');
        }

        // ✅ store
        Review::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Review submitted successfully');
    }


    public function toggleWishlist(Request $request)
    {
        $userId = auth('customer')->id();
        $productId = $request->product_id;

        $exists = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($exists) {
            $exists->delete();

            return response()->json([
                'status' => 'removed'
            ]);
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return response()->json([
            'status' => 'added'
        ]);
    }


    public function remove(Request $request)
    {
        Wishlist::where('user_id', auth('customer')->id())
            ->where('product_id', $request->product_id)
            ->delete();

        return back()->with('success', 'Removed from wishlist');
    }

    
}
