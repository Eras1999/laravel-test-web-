<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
</head>
<body class="auth-page signin-page">
    <main>
        <section class="auth-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-9">
                        <div class="auth-card">
                            <img src="{{ asset('frontend/img/logo/save sathwa.png') }}" alt="SaveSathwa Logo" class="logo">
                            <div class="auth-header">
                                <h2>Sign In</h2>
                                <p>Welcome back! Please sign in to continue.</p>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('signin.post') }}" method="POST" class="auth-form">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <a href="{{ route('forgot-password') }}" class="forgot-link">Forgot Password?</a>
                                </div>
                                <button type="submit" class="btn auth-btn">Sign In</button>
                            </form>
                            <div class="auth-footer">
                                <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>