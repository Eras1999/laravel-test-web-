<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">

</head>
<body class="auth-page forgot-password-page">
    <main class="auth-wrapper">
        <section class="auth-card">
            <img src="{{ asset('frontend/img/logo/save sathwa.png') }}" alt="SaveSathwa Logo" class="logo">
            <div class="auth-header">
                <h2>Forgot Password</h2>
                <p>Enter your email to reset your password.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="auth-btn">Send Reset Link</button>
            </form>

            <div class="auth-footer">
                <p>Remembered your password? <a href="{{ route('signin') }}">Sign In</a></p>
            </div>
        </section>
    </main>
</body>
</html>