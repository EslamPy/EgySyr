<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/icon.webp') }}" type="image/webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EgySyr</title>
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

        .register-container {
            width: 100%;
            max-width: 500px;
            background: rgba(27, 0, 21, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid;
            border-image: linear-gradient(to right, #f176f3, #910389) 1;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px 0 rgba(145, 3, 137, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header img {
            width: 120px;
            height: auto;
            margin-bottom: 1rem;
        }

        .register-header h1 {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #f176f3 0%, #910389 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .register-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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

        .password-requirements {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .register-button {
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
            margin-top: 1rem;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(145, 3, 137, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .login-link a {
            color: #f176f3;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
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
            .register-container {
                padding: 2rem;
            }

            .register-header h1 {
                font-size: 1.75rem;
            }

            .form-row {
                grid-template-columns: 1fr;
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

    <div class="register-container">
        <div class="register-header">
            <img src="{{ asset('images/logo.webp') }}" alt="EgySyr Logo">
            <h1>Create Account</h1>
            <p>Join our community and explore our services</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus placeholder="Enter your first name">
                    @error('first_name')
                        <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter your last name">
                    @error('last_name')
                        <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                @error('email')
                    <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Enter your phone number">
                @error('phone')
                    <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Create a password">
                <div class="password-requirements">
                    Password must be at least 8 characters long and include letters, numbers, and special characters.
                </div>
                @error('password')
                    <span style="color: #ff4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
            </div>

            <button type="submit" class="register-button">
                Create Account
            </button>
        </form>

        <div class="login-link">
            Already have an account? 
            <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>
</body>
</html> 