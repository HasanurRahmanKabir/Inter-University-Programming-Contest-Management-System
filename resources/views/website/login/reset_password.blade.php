<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Reset Password</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/userlogin.css">
    <style>
        @media (max-width: 380px) {
            .login-card {
                padding: 20px !important;
            }
            .form-control::placeholder {
                font-size: 12px;
            }
            .input-group-text {
                padding: 0.375rem 0.5rem;
            }
            .btn-primary {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-card">
            <div class="brand-logo">
                @if(!empty($setting->header_logo))
                    <img src="{{ asset($setting->header_logo) }}" alt="Header Logo" class="w-100 h-100 rounded-circle">
                @else
                    <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center border"
                        style="background: #f8f9fa; color: #6c757d; font-size: 10px; text-align: center;">
                        Upload Your Logo
                    </div>
                @endif
            </div>

            <h4 class="text-center fw-bold mb-1">Set New Password</h4>
            <p class="text-center text-muted small mb-4">
                Please enter your new password below.
            </p>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('forgot.password.reset.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted mb-2">New Password</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="new_password" class="form-control" id="passwordInput"
                            placeholder="Enter new password" required />
                        <span class="input-group-text bg-white border-start-0" style="cursor: pointer"
                            onclick="togglePassword('passwordInput', 'toggleIcon1')">
                            <i class="fas fa-eye-slash text-muted" id="toggleIcon1"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted mb-2">Confirm Password</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="confirm_password" class="form-control" id="confirmPasswordInput"
                            placeholder="Confirm new password" required />
                        <span class="input-group-text bg-white border-start-0" style="cursor: pointer"
                            onclick="togglePassword('confirmPasswordInput', 'toggleIcon2')">
                            <i class="fas fa-eye-slash text-muted" id="toggleIcon2"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
                    Reset Password <i class="fas fa-save ms-2"></i>
                </button>
            </form>
        </div>
    </div>
    <script src="{{ asset('content/website') }}/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        // Redirect to login page after 5 minutes (300000 milliseconds) of inactivity
        setTimeout(function() {
            window.location.href = "{{ route('user.login') }}";
        }, 300000);
    </script>
</body>

</html>
