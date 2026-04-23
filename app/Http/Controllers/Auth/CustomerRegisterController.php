<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CustomerRegisterController extends Controller
{
    public function showForm()
    {
        return view('front-pages.register');
    }


    public function register(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|digits_between:10,15',
            'password' => 'required|confirmed|min:6',
        ]);

        // ✅ Store old session BEFORE login
        $oldSessionId = $request->session()->getId();

        // ✅ Create customer
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // ✅ Login
        Auth::guard('customer')->login($customer);

        // ✅ Regenerate session (security)
        $request->session()->regenerate();

        $newSessionId = $request->session()->getId();

        // 🔥 IMPORTANT: Merge guest cart → user cart
        Cart::where('session_id', $oldSessionId)
            ->update([
                'user_id' => $customer->id,
                'session_id' => $newSessionId
            ]);

        // ✅ Handle intended redirect
        $intendedUrl = session()->pull('url.intended');

        if ($intendedUrl && str_contains($intendedUrl, 'checkout')) {
            return redirect($intendedUrl);
        }

        // ✅ Default redirect
        return redirect()->route('user-dashboard');
    }
}