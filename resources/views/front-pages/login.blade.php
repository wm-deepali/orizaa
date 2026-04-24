@extends('layouts.app')

@section('content')

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

    <div class="login-wrapper">
        <div class="login-card">

            <!-- LEFT -->
            <div class="login-left">
                <img src="{{ asset('images/orizaa-new-logo.png') }}" alt="Login">
            </div>

            <!-- RIGHT -->
            <div class="login-right">
                <div class="login-box">

                    <h2>Welcome Back</h2>
                    <p>Login to your account</p>

                    {{-- ✅ ERROR MESSAGE --}}
                    @if(session('error'))
                        <div style="background:#ffe5e5;color:#b30000;padding:10px;border-radius:6px;margin-bottom:15px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- ✅ VALIDATION ERRORS --}}
                    @if ($errors->any())
                        <div style="background:#ffe5e5;color:#b30000;padding:10px;border-radius:6px;margin-bottom:15px;">
                            <ul style="margin:0;padding-left:18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user-login.smart') }}">
                        @csrf

                        <!-- EMAIL / PHONE -->
                        <input type="text" name="login" id="loginInput" value="{{ old('login') }}"
                            placeholder="Enter Email or Mobile">

                        @error('login')
                            <span class="error-text">{{ $message }}</span>
                        @enderror

                        <!-- PASSWORD (EMAIL CASE) -->
                       <div id="passwordBox" style="display:none;">
                            <input type="password" name="password" placeholder="Password">
                        </div>


                        <!-- OTP SECTION -->
                        <div id="otpBox" style="display:none;">
                            <button type="button" id="sendOtpBtn" class="login-btn" style="margin-bottom:10px;">
                                Send OTP
                            </button>

                            <input type="text" name="otp" placeholder="Enter OTP">

                            <small id="timer" style="display:none;">Resend in 60s</small>

                        </div>

                        <div style="text-align:right;margin-bottom:10px;">
                            <a href="{{ route('forgot.password') }}" id="forgotBtn" style="font-size:12px;color:#c9a55c;">
                                Forgot Password?
                            </a>

                        </div>

                        <button type="submit" class="login-btn">Login</button>
                    </form>
                    <div class="login-footer">
                        Don’t have an account?
                        <a href="{{ route('user-register') }}">Register</a>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        let intended = localStorage.getItem('intended_url');

        if (intended) {
            let form = document.querySelector('form');

            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'intended';
            input.value = intended;

            form.appendChild(input);

            localStorage.removeItem('intended_url');
        }
    </script>

    <script>
        let loginInput = document.getElementById('loginInput');
        let passwordBox = document.getElementById('passwordBox');
        let otpBox = document.getElementById('otpBox');
        let sendBtn = document.getElementById('sendOtpBtn');
        let timerText = document.getElementById('timer');

        let countdown;

        loginInput.addEventListener('input', function () {

            let value = loginInput.value;

            if (/^\d{10,}$/.test(value)) {
                // MOBILE
                passwordBox.style.display = 'none';
                otpBox.style.display = 'block';
            } else {
                // EMAIL
                passwordBox.style.display = 'block';
                otpBox.style.display = 'none';
            }
        });

        sendBtn.addEventListener('click', function () {

            let mobile = loginInput.value;

            fetch("{{ route('send.login.otp') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ phone: mobile })
            });

            sendBtn.disabled = true;

            let time = 60;
            timerText.style.display = 'block';

            countdown = setInterval(() => {
                time--;
                timerText.innerText = "Resend in " + time + "s";

                if (time <= 0) {
                    clearInterval(countdown);
                    sendBtn.disabled = false;
                    timerText.style.display = 'none';
                }
            }, 1000);
        });
    </script>

@endsection