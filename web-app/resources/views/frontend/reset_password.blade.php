<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SaveSathwa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="auth-page reset-password-page">
    <main class="auth-wrapper">
        <section class="auth-card">
            <img src="{{ asset('frontend/img/logo/save sathwa.png') }}" alt="SaveSathwa Logo" class="logo">
            <div class="auth-header">
                <h2>Reset Password</h2>
                <p>Enter your new password below.</p>
            </div>

            <form id="reset-password-form" action="{{ URL::temporarySignedRoute('front.password.update', now()->addMinutes(30), ['user' => $user->id]) }}" method="POST" class="auth-form">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                </div>
                <button type="submit" class="auth-btn">Reset Password</button>
            </form>

            <div class="auth-footer">
                <p>Back to <a href="{{ route('signin') }}">Sign In</a></p>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // SweetAlert for success messages
            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('status') }}',
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
            document.getElementById('reset-password-form').addEventListener('submit', function () {
                Swal.fire({
                    title: 'Processing',
                    text: 'Please wait while we reset your password...',
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