<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\Http;

class CustomerRegisterController extends Controller
{
    public function showForm()
    {
        return view('front-pages.register');
    }


    /////////////////////////////////////////////////////
// STEP 1: SEND OTP
/////////////////////////////////////////////////////
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:10,15'
        ]);

        $otp = rand(100000, 999999);

        session([
            'otp' => $otp,
            'otp_phone' => $request->phone,
            'otp_expires_at' => now()->addMinutes(10),
            'otp_sent' => true,
            'otp_verified' => false
        ]);

        // 🔥 SAME SMS SERVICE
        $message = "$otp is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";

        $this->sendOtpSms($request->phone, $message);

        return redirect()->back()->with('success', 'OTP sent successfully');
    }

    /////////////////////////////////////////////////////
// STEP 2: VERIFY OTP
/////////////////////////////////////////////////////
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        // ❌ Wrong OTP
        if (session('otp') != $request->otp) {
            return back()->with('error', 'Invalid OTP');
        }

        // ❌ Expired OTP
        if (now()->gt(session('otp_expires_at'))) {
            return back()->with('error', 'OTP expired');
        }

        // ✅ Verified
        session(['otp_verified' => true]);

        return redirect()->back()->with('success', 'OTP verified');
    }

    /////////////////////////////////////////////////////
// STEP 3: FINAL REGISTER
/////////////////////////////////////////////////////
    public function registerFinal(Request $request)
    {
        if (!session('otp_verified')) {
            return redirect()->back()->with('error', 'Please verify OTP first');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $oldSessionId = $request->session()->getId();

        // ✅ Create user (ONLY AFTER OTP)
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => session('otp_phone'),
            'password' => Hash::make($request->password),
        ]);

        // ✅ Login
        Auth::guard('customer')->login($customer);

        // ✅ Regenerate session
        $request->session()->regenerate();

        $newSessionId = $request->session()->getId();

        // 🔥 MERGE CART
        Cart::where('session_id', $oldSessionId)
            ->update([
                'user_id' => $customer->id,
                'session_id' => $newSessionId
            ]);

        // 🔥 CLEAR OTP DATA
        session()->forget([
            'otp',
            'otp_phone',
            'otp_expires_at',
            'otp_sent',
            'otp_verified'
        ]);

        // 🔥 REDIRECT FIX (IMPORTANT)
        $intendedUrl = session()->pull('url.intended') ?? $request->input('intended');

        if ($intendedUrl) {
            return redirect($intendedUrl);
        }

        return redirect()->route('user-dashboard');
    }


    private function sendOtpSms($mobile, $message)
    {
        $mobile_number = '91' . $mobile;
        $dlt_id = '1307161465983326774';

        // encode message like browser
        $encodedMessage = rawurlencode($message);

        $url = "http://sms.webmingo.in/api/sendhttp.php";
        $url .= "?authkey=133780A8wYdynRwZ69ccbd4dP1";
        $url .= "&mobiles={$mobile_number}";
        $url .= "&sender=WMINGO";
        $url .= "&message={$encodedMessage}";
        $url .= "&route=4";
        $url .= "&country=91";
        $url .= "&DLT_TE_ID={$dlt_id}";
        $url .= "&PE_ID=1301160576431389865";

        \Log::info('SMS URL', ['url' => $url]);

        $response = Http::withoutVerifying()
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0',
            ])
            ->get($url);

        \Log::info('SMS Response', [
            'body' => $response->body(),
            'status' => $response->status()
        ]);
    }
}