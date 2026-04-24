<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CustomerLoginController extends Controller
{
    public function showForm()
    {
        return view('front-pages.login');
    }


    public function sendLoginOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:10,15'
        ]);

        $otp = rand(100000, 999999);

        session([
            'login_otp' => $otp,
            'login_phone' => $request->phone,
            'login_otp_expires' => now()->addMinutes(10)
        ]);

        $message = "$otp is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";

        $this->sendOtpSms($request->phone, $message);

        return response()->json(['status' => true]);
    }

    public function smartLogin(Request $request)
    {
        $input = $request->login;

        // EMAIL LOGIN
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {

            if (
                Auth::guard('customer')->attempt([
                    'email' => $input,
                    'password' => $request->password
                ])
            ) {
                return redirect()->route('user-dashboard');
            }

            return back()->with('error', 'Invalid credentials');
        }

        // MOBILE OTP LOGIN
        if ($request->otp != session('login_otp')) {
            return back()->with('error', 'Invalid OTP');
        }

        if (now()->gt(session('login_otp_expires'))) {
            return back()->with('error', 'OTP expired');
        }

        $user = Customer::where('phone', session('login_phone'))->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        Auth::guard('customer')->login($user);

        session()->forget(['login_otp', 'login_phone', 'login_otp_expires']);

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

    public function forgotForm()
    {
        return view('front-pages.forgot-password');
    }

    public function sendForgotOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Customer::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        $otp = rand(100000, 999999);

        session([
            'forgot_otp' => $otp,
            'forgot_email' => $request->email,
            'forgot_otp_expires' => now()->addMinutes(10),
            'forgot_otp_sent' => true
        ]);

        \Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)->subject('Reset Password OTP');
        });

        return back()->with('success', 'OTP sent to email');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($request->otp != session('forgot_otp')) {
            return back()->with('error', 'Invalid OTP');
        }

        if (now()->gt(session('forgot_otp_expires'))) {
            return back()->with('error', 'OTP expired');
        }

        $user = Customer::where('email', session('forgot_email'))->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        session()->forget([
            'forgot_otp',
            'forgot_email',
            'forgot_otp_expires',
            'forgot_otp_sent'
        ]);

        return redirect()->route('user-login')->with('success', 'Password updated successfully');
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