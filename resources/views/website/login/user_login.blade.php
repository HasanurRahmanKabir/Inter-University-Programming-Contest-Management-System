<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - User Login</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('content/website/image/favicon.ico') }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/userlogin.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 px-3 px-sm-0">
        <div class="login-card p-4 p-sm-5 mx-auto w-100">
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

            <h4 class="text-center fw-bold mb-1">Welcome Back!</h4>
            <p class="text-center text-muted small mb-4">
                Sign in to access your
                {{ (!empty($contestinfo) && $contestinfo->status == 1 && !empty($contestinfo->title)) ? $contestinfo->title : 'Contest Title' }} Account
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

            <form action="{{ route('user.login.submit') }}" method="POST">
                @csrf <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            value="{{ old('email') }}" required />
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted mb-2">Password</label>

                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="passwordInput"
                            placeholder="Enter your password" required />
                        <span class="input-group-text bg-white border-start-0" style="cursor: pointer"
                            onclick="togglePassword()">
                            <i class="fas fa-eye-slash text-muted" id="toggleIcon"></i>
                        </span>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('forgot.password') }}" class="small text-primary fw-bold text-decoration-none">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" value="1" class="form-check-input" id="rememberCheck" />
                    <label class="form-check-label small text-muted" for="rememberCheck">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
                    Sign In <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-3 border-top pt-3">
                <small class="text-muted">Don't have an account?
                    @if (isset($isRegistrationOpen) && $isRegistrationOpen)
                        <a href="{{ route('team.registration') }}" class="text-primary text-decoration-none fw-bold">Sign
                            Up</a>
                    @else
                        <span class="text-danger fw-bold">Registration Closed</span>
                    @endif
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("passwordInput");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            }
        }
    </script>

    <!-- Mobile Bottom Navigation Bar (Visible only on mobile/tablet) -->
    <div class="mobile-bottom-nav d-lg-none fixed-bottom shadow-lg" style="padding-bottom: env(safe-area-inset-bottom); z-index: 1040;">
        <div class="d-flex justify-content-around align-items-center py-2 px-2">
            <a href="{{ url('/') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-home fs-5 mb-1"></i>
                <span>Home</span>
            </a>
            <a href="{{ url('/notice-info') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-bullhorn fs-5 mb-1"></i>
                <span>Notice</span>
            </a>
            <a href="{{ url('/rules') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-gavel fs-5 mb-1"></i>
                <span>Rules</span>
            </a>
            <a href="{{ url('/registration-info') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-users fs-5 mb-1"></i>
                <span>Teams</span>
            </a>
            <a href="{{ route('user.login') }}" class="nav-item text-center text-decoration-none text-primary d-flex flex-column align-items-center">
                <i class="fas fa-user-circle fs-5 mb-1"></i>
                <span>Login</span>
            </a>
        </div>
    </div>

    <style>
        /* Mobile App Navbar Styles */
        @media (max-width: 991.98px) {
            .container.min-vh-100 {
                padding-bottom: 54px !important; /* Exactly matches navbar height to avoid extra gap */
            }
        }

        .mobile-bottom-nav {
            background-color: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05) !important;
        }
        
        .mobile-bottom-nav .nav-item {
            width: 20%;
            transition: all 0.2s ease-in-out;
        }

        .mobile-bottom-nav .nav-item span {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        
        .mobile-bottom-nav .nav-item i {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .mobile-bottom-nav .nav-item:hover, .mobile-bottom-nav .nav-item:active {
            color: #0d6efd !important;
        }

        .mobile-bottom-nav .nav-item:hover i, .mobile-bottom-nav .nav-item:active i {
            transform: scale(1.15) translateY(-2px);
        }
    </style>
</body>

</html>