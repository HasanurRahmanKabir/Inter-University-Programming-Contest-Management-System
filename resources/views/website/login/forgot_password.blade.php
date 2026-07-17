<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('content/website/image/favicon.ico') }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/userlogin.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/dark-mode.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 px-3 px-sm-0">
        <div class="login-card p-4 p-sm-5 mx-auto w-100">
            <div class="brand-logo">
                @if(!empty($setting->header_logo))
                    <img src="{{ asset($setting->header_logo) }}" alt="Header Logo" class="w-100 h-100 rounded-circle">
                @else
                    <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center border custom-logo-placeholder fw-bold"
                        style="background: #f8f9fa; color: #6c757d; font-size: 10px; text-align: center;">
                        Upload Your Logo
                    </div>
                @endif
            </div>

            <h4 class="text-center fw-bold mb-1">Forgot Password</h4>
            <p class="text-center text-muted small mb-4">
                Enter your registered email address and we'll send you a 6-digit verification code.
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

            <form action="{{ route('forgot.password.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            value="{{ old('email') }}" required />
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
                    Send OTP <i class="fas fa-paper-plane ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-3 border-top pt-3">
                <small class="text-muted">Remembered your password?
                    <a href="{{ route('user.login') }}" class="text-primary text-decoration-none fw-bold">Sign In</a>
                </small>
            </div>
        </div>
    </div>
    <script src="{{ asset('content/website') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('content/website') }}/js/dark-mode.js"></script>
</body>

</html>
