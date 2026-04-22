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
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* LEFT */
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

    /* RIGHT */
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
        box-shadow: 0 0 0 2px rgba(201,165,92,0.2);
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

    .signup-btn:hover {
        opacity: 0.9;
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

    /* RESPONSIVE */
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

        <!-- LEFT IMAGE -->
        <div class="signup-left">
            <img src="{{ asset('images/signup-banner.jpg') }}" alt="Signup">
        </div>

        <!-- RIGHT FORM -->
        <div class="signup-right">
            <div class="signup-box">
                <h2>Create Account</h2>
                <p>Start your shopping journey</p>

                <form method="POST" action="#">
                    @csrf

                    <input type="text" name="name" placeholder="Full Name" required>
                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                    <button type="submit" class="signup-btn">Sign Up</button>
                </form>

                <div class="signup-footer">
                    Already have an account? <a href="/login">Login</a>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection