<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
</head>
<body class="auth-page signup-page">
    <main>
        <section class="auth-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-9">
                        <div class="auth-card">
                            <img src="{{ asset('frontend/img/logo/save sathwa.png') }}" alt="SaveSathwa Logo" class="logo">
                            <div class="auth-header">
                                <h2>Sign Up</h2>
                                <p>Create an account to join our community!</p>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
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
                            <form action="{{ route('signup.post') }}" method="POST" class="auth-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                                        <label for="terms" class="form-check-label">I agree to the <a href="{{ route('terms-conditions') }}">Terms and Conditions</a></label>
                                    </div>
                                </div>
                                <button type="submit" class="btn auth-btn">Sign Up</button>
                            </form>
                            <div class="auth-footer">
                                <p>Already have an account? <a href="{{ route('signin') }}">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>