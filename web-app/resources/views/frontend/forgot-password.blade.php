<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
</head>
<body class="auth-page forgot-password-page">
    <main>
        <section class="auth-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-9">
                        <div class="auth-card">
                            <div class="auth-header">
                                <h2>Forgot Password</h2>
                                <p>Enter your email to reset your password.</p>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('forgot-password.post') }}" method="POST" class="auth-form">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                                </div>
                                <button type="submit" class="btn auth-btn">Send Reset Link</button>
                            </form>
                            <div class="auth-footer">
                                <p>Remembered your password? <a href="{{ route('signin') }}">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>