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
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    /* LEFT */
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

    /* RIGHT */
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
        box-shadow: 0 0 0 2px rgba(201,165,92,0.2);
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

    .login-btn:hover {
        opacity: 0.9;
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

    /* RESPONSIVE */
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

        <!-- LEFT IMAGE -->
        <div class="login-left">
            <img src="{{ asset('images/login-banner.jpg') }}" alt="Login">
        </div>

        <!-- RIGHT FORM -->
        <div class="login-right">
            <div class="login-box">
                <h2>Welcome Back</h2>
                <p>Login to your account</p>

                <form method="POST" action="#">
                    @csrf

                    <input type="email" name="email" placeholder="Email Address" required>
                    <input type="password" name="password" placeholder="Password" required>

                    <button type="submit" class="login-btn">Login</button>
                </form>

                <div class="login-footer">
                    Don’t have an account? <a href="#">Register</a>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection