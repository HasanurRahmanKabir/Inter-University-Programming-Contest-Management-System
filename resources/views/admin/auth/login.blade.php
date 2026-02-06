<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUBIUPC - Admin Login</title>

    <link href="{{ asset('content/admin') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/admin_login.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-card">
            <div class="brand-logo">
                <img src="{{ asset('content/admin') }}/image/sub_logo.jpg" alt="SUBIUPC Logo" class="w-100 h-100 rounded-circle" />
            </div>

            <h4 class="text-center fw-bold mb-1">Welcome Back!</h4>
            <p class="text-center text-muted small mb-4">
                Sign in to manage SUBIUPC Admin Panel
            </p>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" 
                               value="{{ old('email') }}" required />
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Enter your password" required />
                        <span class="input-group-text bg-white border-start-0" style="cursor: pointer" onclick="togglePassword()">
                            <i class="fas fa-eye-slash text-muted" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="rememberCheck" />
                        <label class="form-check-label small text-muted" for="rememberCheck">Remember me</label>
                    </div>
                    <a href="#" class="small text-decoration-none text-primary fw-bold">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3">
                    Sign In <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </form>
            <div class="text-center mt-3 border-top pt-3">
                <small class="text-muted">Don't have an account?
                    <a href="#" class="text-primary text-decoration-none fw-bold">Contact Super Admin</a></small>
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
</body>

</html>