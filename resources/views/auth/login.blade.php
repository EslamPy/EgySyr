<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EgySyr</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #1B0015;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .background-video video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            background: rgba(27, 0, 21, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid;
            border-image: linear-gradient(to right, #f176f3, #910389) 1;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px 0 rgba(145, 3, 137, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header img {
            width: 120px;
            height: auto;
            margin-bottom: 1rem;
        }

        .login-header h1 {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #f176f3 0%, #910389 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #fff;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(145, 3, 137, 0.3);
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #f176f3;
            background: rgba(255, 255, 255, 0.1);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .forgot-password {
            color: #f176f3;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #910389;
        }

        .login-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #f176f3 0%, #910389 100%);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(145, 3, 137, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .register-link a {
            color: #f176f3;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #910389;
        }

        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            background: linear-gradient(135deg, #f176f3 0%, #910389 100%);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 150px;
            height: 150px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 100px;
            height: 100px;
            top: 20%;
            right: 15%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 200px;
            height: 200px;
            bottom: 15%;
            right: 10%;
            animation-delay: -10s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            50% {
                transform: translate(100px, 100px) rotate(180deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="background-video">
        <video autoplay muted loop>
            <source src="{{ asset('images/bc.mp4') }}" type="video/mp4">
        </video>
    </div>

    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('images/logo.webp') }}" alt="EgySyr Logo">
            <h1>Welcome Back</h1>
            <p>Enter your credentials to access your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                @error('email')
                    <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                @error('password')
                    <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <button type="submit" class="login-button">
                Sign In
            </button>
        </form>

        <div class="register-link">
            Don't have an account? 
            <a href="{{ route('register') }}">Create Account</a>
        </div>
    </div>
</body>
</html> 