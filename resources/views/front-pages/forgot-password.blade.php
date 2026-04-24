@extends('layouts.app')

  <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            display: flex;
            width: 900px;
            max-width: 100%;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .login-left {
            width: 50%;
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .login-left img {
            max-width: 100%;
            border-radius: 10px;
        }

        .login-right {
            width: 50%;
            padding: 40px;
            display: flex;
            align-items: center;
        }

        .login-box {
            width: 100%;
        }

        .login-box h2 {
            font-size: 26px;
            margin-bottom: 10px;
            color: #111;
        }

        .login-box p {
            font-size: 14px;
            margin-bottom: 20px;
            color: #666;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .login-box input:focus {
            border-color: #c9a55c;
            outline: none;
            box-shadow: 0 0 0 2px rgba(201, 165, 92, 0.2);
        }

        .error-text {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
            display: block;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            border: none;
            color: #fff;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .login-footer {
            margin-top: 15px;
            font-size: 13px;
            text-align: center;
        }

        .login-footer a {
            color: #c9a55c;
            text-decoration: none;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }

            .login-left {
                width: 100%;
                height: 180px;
            }

            .login-right {
                width: 100%;
                padding: 25px;
            }
        }
    </style>

@section('content')

<div class="login-wrapper">
    <div class="login-card">

    <div class="login-left">
        <img src="{{ asset('images/orizaa-new-logo.png') }}">
    </div>

    <div class="login-right">
        <div class="login-box">

            <h2>Reset Password</h2>

            @if(session('error'))
                <div style="color:red">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div style="color:green">{{ session('success') }}</div>
            @endif

            {{-- STEP 1 --}}
            @if(!session('forgot_otp_sent'))

            <form method="POST" action="{{ route('forgot.send.otp') }}">
                @csrf

                <input type="email" name="email" placeholder="Enter Email">

                <button class="login-btn">Send OTP</button>
            </form>

            @endif

            {{-- STEP 2 --}}
            @if(session('forgot_otp_sent'))

            <form method="POST" action="{{ route('forgot.reset') }}">
                @csrf

                <input type="text" name="otp" placeholder="Enter OTP">

                <input type="password" name="password" placeholder="New Password">

                <input type="password" name="password_confirmation" placeholder="Confirm Password">

                <button class="login-btn">Reset Password</button>
            </form>

            @endif

            <div class="login-footer">
                <a href="{{ route('user-login') }}">Back to Login</a>
            </div>

        </div>
    </div>

</div>

</div>

@endsection
