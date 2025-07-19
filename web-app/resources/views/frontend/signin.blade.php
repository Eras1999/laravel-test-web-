<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="auth-page signin-page">
    <main class="auth-wrapper">
        <section class="auth-card">
            <img src="{{ asset('frontend/img/logo/save sathwa.png') }}" alt="SaveSathwa Logo" class="logo">
            <div class="auth-header">
                <h2>Sign In</h2>
                <p>Welcome back! Please sign in to continue.</p>
            </div>

            <form id="signin-form" action="{{ route('signin.post') }}" method="POST" class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="form-group d-flex">
                    <div class="form-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember Me</label>
                    </div>
                    <a href="{{ route('forgot-password') }}" class="forgot-link">Forgot Password?</a>
                </div>
                <button type="submit" class="auth-btn">Sign In</button>
            </form>

            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // SweetAlert for success messages
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'OK'
                });
            @endif

            // SweetAlert for error messages
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: `<ul style="text-align: left; list-style: none; padding: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                           </ul>`,
                    confirmButtonColor: '#4f46e5',
                    confirmButtonText: 'OK'
                });
            @endif

            // SweetAlert for showing loading state on form submission
            document.getElementById('signin-form').addEventListener('submit', function () {
                Swal.fire({
                    title: 'Logging in...',
                    text: 'Please wait while we sign you in...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });
    </script>
</body>
</html>