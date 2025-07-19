<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="auth-page signup-page">
    <main class="auth-wrapper">
        <section class="auth-card">
            <img src="{{ asset('frontend/img/logo/save sathwa.png') }}" alt="SaveSathwa Logo" class="logo">
            <div class="auth-header">
                <h2>Sign Up</h2>
                <p>Create an account to join our community!</p>
            </div>

            <form id="signup-form" action="{{ route('signup.post') }}" method="POST" class="auth-form">
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
                <button type="submit" class="auth-btn">Sign Up</button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('signin') }}">Sign In</a></p>
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
            document.getElementById('signup-form').addEventListener('submit', function () {
                Swal.fire({
                    title: 'Processing',
                    text: 'Please wait while we create your account...',
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