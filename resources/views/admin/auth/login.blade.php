<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Admin Login</title>

    <link href="{{ asset('content/admin') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/admin_login.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 px-3 px-sm-0">
        <div class="login-card p-4 p-sm-5 mx-auto w-100">
            <div class="brand-logo">
                @if(!empty($setting->header_logo))
                    <img src="{{ asset($setting->header_logo) }}" alt="Your Logo" class="w-100 h-100 rounded-circle" style="object-fit: contain;">
                @else
                    <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center border"
                        style="background: #f8f9fa; color: #6c757d; font-size: 10px; text-align: center;">
                        Upload Your Logo
                    </div>
                @endif
            </div>

            <h4 class="text-center fw-bold mb-1">Welcome Back!</h4>
            <p class="text-center text-muted small mb-4 text-break">
                Sign in to manage {{ $setting->website_name ?? 'Your Website Name' }} Admin Panel
            </p>

            <!-- Theme-Matched Professional Demo Credentials Block -->
            <div class="w-100 mb-4 overflow-hidden rounded-4 shadow-sm" style="border: 1px solid #e2e8f0; border-left: 4px solid #3b82f6;">
                <div class="overflow-auto w-100" style="-ms-overflow-style: none; scrollbar-width: none;">
                    <div class="demo-credentials-block p-3" style="min-width: 260px; background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
                        
                        <div class="d-flex align-items-center flex-wrap justify-content-between gap-2 mb-3 w-100">
                            <div class="d-flex align-items-center">
                                <div class="icon-box d-flex align-items-center justify-content-center rounded-circle me-2 shadow-sm flex-shrink-0" style="width: 30px; height: 30px; background-color: #eff6ff; border: 1px solid #bfdbfe; color: #3b82f6;">
                                    <i class="fas fa-shield-alt" style="font-size: 13px;"></i>
                                </div>
                                <span class="fw-bold text-nowrap" style="color: #1e293b; font-size: 14px;">Demo Access</span>
                            </div>
                            <span class="badge shadow-sm text-nowrap" style="background-color: #ffffff; color: #3b82f6; font-size: 10px; font-weight: 600; border: 1px solid #bfdbfe; padding: 6px 8px;">ONE CLICK COPY</span>
                        </div>
                        
                        <div class="credential-item p-2 mb-2 rounded-3 border w-100" style="background-color: #ffffff; border-color: #e2e8f0; cursor: pointer; transition: all 0.25s;" onclick="copyDemoText('superadmin@gmail.com', this)" onmouseover="this.style.borderColor='#3b82f6'; this.style.backgroundColor='#eff6ff'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#ffffff'">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-envelope text-primary opacity-75 me-2 flex-shrink-0" style="font-size: 13px;"></i>
                                <span class="text-muted small fw-medium text-nowrap">Email:</span>
                                <i class="far fa-copy text-primary opacity-50 copy-icon ms-auto flex-shrink-0" style="font-size: 13px;"></i>
                            </div>
                            <div class="fw-bold ps-4 text-nowrap" style="color: #0f172a; font-size: 13px;">superadmin@gmail.com</div>
                        </div>
                        
                        <div class="credential-item p-2 rounded-3 border w-100" style="background-color: #ffffff; border-color: #e2e8f0; cursor: pointer; transition: all 0.25s;" onclick="copyDemoText('12345678', this)" onmouseover="this.style.borderColor='#3b82f6'; this.style.backgroundColor='#eff6ff'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#ffffff'">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-key text-primary opacity-75 me-2 flex-shrink-0" style="font-size: 13px;"></i>
                                <span class="text-muted small fw-medium text-nowrap">Password:</span>
                                <i class="far fa-copy text-primary opacity-50 copy-icon ms-auto flex-shrink-0" style="font-size: 13px;"></i>
                            </div>
                            <div class="fw-bold ps-4 text-nowrap" style="color: #0f172a; font-size: 13px; letter-spacing: 1px;">12345678</div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                        <input type="password" name="password" class="form-control" id="passwordInput"
                            placeholder="Enter your password" required />
                        <span class="input-group-text bg-white border-start-0" style="cursor: pointer"
                            onclick="togglePassword()">
                            <i class="fas fa-eye-slash text-muted" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" name="remember" value="1" class="form-check-input" id="rememberCheck" />
                        <label class="form-check-label small text-muted" for="rememberCheck">Remember me</label>
                    </div>
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

        function copyDemoText(text, element) {
            navigator.clipboard.writeText(text).then(() => {
                const icon = element.querySelector('.copy-icon');
                if (icon) {
                    icon.classList.remove('fa-copy', 'far');
                    icon.classList.add('fa-check', 'fas', 'text-success');
                    setTimeout(() => {
                        icon.classList.remove('fa-check', 'fas', 'text-success');
                        icon.classList.add('fa-copy', 'far');
                    }, 2000);
                }
            });
        }
    </script>

    @if(session('inactive_account'))
        <!-- Inactive Account Modal -->
        <div class="modal fade" id="inactiveAccountModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered px-3">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                    <div class="modal-header border-0 pb-0 justify-content-center mt-4">
                        <div class="text-danger bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-lock fa-3x opacity-75"></i>
                        </div>
                    </div>
                    <div class="modal-body text-center pb-5 pt-4 px-sm-5">
                        <h4 class="fw-bold text-dark mb-3">Account Inactive</h4>
                        <p class="text-muted mb-4" style="line-height: 1.6;">
                            {{ session('inactive_account') }}
                        </p>
                        <button type="button" class="btn btn-danger px-5 py-2 rounded-pill fw-medium shadow-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var inactiveModal = new bootstrap.Modal(document.getElementById('inactiveAccountModal'));
                inactiveModal.show();
            });
        </script>
    @endif
</body>

</html>
