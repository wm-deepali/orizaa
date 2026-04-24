@extends('layouts.app')


@section('content')

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .signup-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-card {
            display: flex;
            width: 950px;
            max-width: 100%;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .signup-left {
            width: 50%;
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .signup-left img {
            max-width: 100%;
            border-radius: 10px;
        }

        .signup-right {
            width: 50%;
            padding: 40px;
            display: flex;
            align-items: center;
        }

        .signup-box {
            width: 100%;
        }

        .signup-box h2 {
            font-size: 26px;
            margin-bottom: 10px;
            color: #111;
        }

        .signup-box p {
            font-size: 14px;
            margin-bottom: 20px;
            color: #666;
        }

        .signup-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .signup-box input:focus {
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

        .signup-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            border: none;
            color: #fff;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .signup-footer {
            margin-top: 15px;
            font-size: 13px;
            text-align: center;
        }

        .signup-footer a {
            color: #c9a55c;
            text-decoration: none;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .signup-card {
                flex-direction: column;
            }

            .signup-left {
                width: 100%;
                height: 180px;
            }

            .signup-right {
                width: 100%;
                padding: 25px;
            }
        }
    </style>

    <div class="signup-wrapper">
        <div class="signup-card">

            <!-- LEFT -->
            <div class="signup-left">
                <img src="{{ asset('images/orizaa-new-logo.png') }}" alt="Signup">
            </div>

            <!-- RIGHT -->
            <div class="signup-right">
                <div class="signup-box">

                    <h2>Create Account</h2>
                    <p>Start your shopping journey</p>

                    {{-- ✅ SUCCESS MESSAGE --}}
                    @if(session('success'))
                        <div style="background:#e6ffed;color:#006b2d;padding:10px;border-radius:6px;margin-bottom:15px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ✅ GLOBAL ERRORS --}}
                    @if ($errors->any())
                        <div style="background:#ffe5e5;color:#b30000;padding:10px;border-radius:6px;margin-bottom:15px;">
                            <ul style="margin:0;padding-left:18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- STEP 1: PHONE --}}
                    @if(!session('otp_sent'))

                        <form method="POST" action="{{ route('send.otp') }}">
                            @csrf

                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Enter Mobile Number">

                            @error('phone')
                                <span class="error-text">{{ $message }}</span>
                            @enderror

                            <button type="submit" class="signup-btn">Send OTP</button>
                        </form>

                    @endif


                    {{-- STEP 2: OTP --}}
                    @if(session('otp_sent') && !session('otp_verified'))

                        <form method="POST" action="{{ route('verify.otp') }}">
                            @csrf

                            <input type="text" name="otp" placeholder="Enter OTP" maxlength="6" pattern="[0-9]{6}">

                            <button type="submit" class="signup-btn">Verify OTP</button>
                        </form>

                    @endif


                    {{-- STEP 3: FINAL REGISTER --}}
                    @if(session('otp_verified'))

                        <form method="POST" action="{{ route('register.final') }}">
                            @csrf

                            <!-- NAME -->
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name">
                            @error('name')
                                <span class="error-text">{{ $message }}</span>
                            @enderror

                            <!-- EMAIL -->
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror

                            <!-- PHONE (LOCKED) -->
                            <input type="tel" value="{{ session('otp_phone') }}" readonly>

                            <!-- PASSWORD -->
                            <input type="password" name="password" placeholder="Password">

                            <small style="font-size:12px;color:#666;display:block;margin-top:-10px;margin-bottom:10px;">
                                Password should be minimum 8 characters long with one uppercase letter and one special character
                            </small>
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror

                            <input type="password" name="password_confirmation" placeholder="Confirm Password">

                            <button type="submit" class="signup-btn">Sign Up</button>
                        </form>

                    @endif

                    <div class="signup-footer">
                        Already have an account?
                        <a href="{{ route('user-login') }}">Login</a>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        let intended = localStorage.getItem('intended_url');

        if (intended) {
            document.querySelectorAll('form').forEach(form => {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'intended';
                input.value = intended;
                form.appendChild(input);
            });

            localStorage.removeItem('intended_url');
        }
    </script>

@endsection