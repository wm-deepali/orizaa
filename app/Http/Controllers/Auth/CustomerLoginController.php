<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    public function showForm()
    {
        return view('front-pages.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // 👇 store OLD session BEFORE login
        $oldSessionId = $request->session()->getId();

        if (Auth::guard('customer')->attempt($credentials, $request->filled('remember'))) {

            $request->session()->regenerate();

            $newSessionId = $request->session()->getId();
            $userId = Auth::guard('customer')->id();

            // 🔥 MOVE guest cart → user
            Cart::where('session_id', $oldSessionId)
                ->update([
                    'user_id' => $userId,
                    'session_id' => $newSessionId
                ]);

            // redirect logic
            $intendedUrl = session()->pull('url.intended');

            if ($intendedUrl && str_contains($intendedUrl, 'checkout')) {
                return redirect($intendedUrl);
            }

            return redirect()->route('user-dashboard');
        }

        return back()->withInput()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        // ✅ Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}