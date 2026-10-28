<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Premium Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->admin_favicon) ? asset($setting->admin_favicon) : (!empty($setting->website_favicon) ? asset($setting->website_favicon) : asset('assets/website/image/favicon.ico')) }}">
    <script>
        (function() {
            var savedTheme = localStorage.getItem('admin_theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/admin-dark-mode.css">
    <style>
        .admin-password-group .form-control {
            border-color: #dee2e6;
            box-shadow: none !important;
        }
        .admin-password-group .password-toggle-btn {
            background-color: transparent !important;
            border-color: #dee2e6 !important;
            color: #6c757d;
            box-shadow: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.375rem 0.75rem;
            cursor: pointer;
            transition: color 0.2s ease, border-color 0.2s ease;
        }
        .admin-password-group .password-toggle-btn:hover,
        .admin-password-group .password-toggle-btn:focus {
            background-color: transparent !important;
            color: #3b82f6 !important;
            box-shadow: none !important;
        }
        .admin-password-group:focus-within .form-control,
        .admin-password-group:focus-within .password-toggle-btn {
            border-color: #86b7fe !important;
        }
        body[data-theme="dark"] .admin-password-group .form-control {
            border-color: rgba(255, 255, 255, 0.15) !important;
            background-color: #0f172a !important;
            color: #e2e8f0 !important;
        }
        body[data-theme="dark"] .admin-password-group .password-toggle-btn {
            background-color: #0f172a !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #94a3b8;
        }
        body[data-theme="dark"] .admin-password-group .password-toggle-btn:hover,
        body[data-theme="dark"] .admin-password-group .password-toggle-btn:focus {
            background-color: #0f172a !important;
            color: #60a5fa !important;
        }
        body[data-theme="dark"] .admin-password-group:focus-within .form-control,
        body[data-theme="dark"] .admin-password-group:focus-within .password-toggle-btn {
            border-color: #3b82f6 !important;
        }

        /* --- Admin Pagination Professional Layout --- */
        nav .pagination {
            margin-bottom: 0 !important;
        }
        nav.d-flex.justify-content-between,
        nav.d-flex.justify-items-center {
            width: 100% !important;
        }

        /* Hide Laravel's bulky Previous/Next text block on all devices */
        nav div.d-sm-none {
            display: none !important;
        }

        /* Always show the clean numeric pagination with Showing counter */
        nav div.flex-sm-fill {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            gap: 1rem !important;
        }
        nav div.flex-sm-fill p.small {
            margin-bottom: 0 !important;
            white-space: nowrap !important;
            font-size: 0.85rem !important;
        }
        nav .pagination .page-link {
            padding: 0.35rem 0.65rem !important;
            font-size: 0.85rem !important;
            line-height: 1.25 !important;
        }

        /* Mobile specific stacking: Showing counter on top, numbers below */
        @media (max-width: 575.98px) {
            nav div.flex-sm-fill {
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                gap: 0.6rem !important;
            }
            nav div.flex-sm-fill p.small {
                white-space: normal !important;
            }
        }

        /* Compact bottom scroll padding so card and Live button have a balanced, tight gap */
        .main-content {
            padding-bottom: 25px !important;
        }
    </style>
</head>

<body>
    <script>
        (function() {
            var savedTheme = localStorage.getItem('admin_theme');
            if (savedTheme === 'dark') {
                document.body.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
<div class="flex min-h-screen">

    <div class="overlay" id="overlay"></div>

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0 text-white">
                Admin <span style="color: #3b82f6">Panel</span>
            </h4>
        </div>
        <div class="sidebar-menu" style="padding-bottom: 80px; position: relative; min-height: calc(100vh - 70px);">
            <a class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}"><i
                    class="fas fa-th-large"></i> Dashboard</a>

            <a class="{{ Request::is('admin/contests*') ? 'active' : '' }}"
                href="{{ url('admin/contests') }}"><i class="fas fa-trophy"></i> Contests</a>
            <a class="{{ Request::is('admin/teams*') ? 'active' : '' }}"
                href="{{ url('admin/teams') }}"><i class="fas fa-users"></i> Teams</a>
            <a class="{{ Request::is('admin/payments*') ? 'active' : '' }}"
                href="{{ url('admin/payments') }}"><i class="fas fa-credit-card"></i> Payments</a>
            <a class="{{ Request::is('admin/kit-status*') ? 'active' : '' }}"
                href="{{ url('admin/kit-status') }}"><i class="fas fa-gift"></i> Kit Status</a>
            <a class="{{ Request::is('admin/download-details*') ? 'active' : '' }}"
                href="{{ url('admin/download-details') }}"><i class="fas fa-download fa-lg me-2"></i>
                Download Details</a>

            <a class="{{ Request::is('admin/volunteers*') ? 'active' : '' }}"
                href="{{ url('admin/volunteers') }}"><i class="fas fa-hand-holding-heart"></i> Volunteers</a>
            <a class="{{ Request::is('admin/sponsors*') ? 'active' : '' }}"
                href="{{ url('admin/sponsors') }}"><i class="fas fa-ad"></i> Sponsors</a>
            <a class="{{ Request::is('admin/notices*') ? 'active' : '' }}"
                href="{{ url('admin/notices') }}"><i class="fas fa-bullhorn"></i> Notices</a>
            <a class="{{ Request::is('admin/rules*') ? 'active' : '' }}"
                href="{{ url('admin/rules') }}"><i class="fas fa-clipboard-list"></i> Rules</a>
            <a class="{{ Request::is('admin/gallery*') ? 'active' : '' }}"
                href="{{ url('admin/gallery') }}"><i class="fas fa-images"></i> Gallery</a>

            <a class="{{ Request::is('admin/admins*') ? 'active' : '' }}"
                href="{{ url('admin/admins') }}"><i class="fas fa-user-cog"></i> Admins</a>
            <a class="{{ Request::is('admin/website-settings*') ? 'active' : '' }}" 
                href="{{ url('admin/website-settings') }}">
                <i class="fas fa-cogs"></i> Website Settings</a>    

            <!-- Clear Cache -->
            <a href="{{ route('admin.clear.cache') }}">
                <i class="fas fa-broom"></i> Clear Cache</a>

            <!-- Theme Toggle -->
            <a href="#" class="theme-toggle-btn">
                <i class="fas fa-lightbulb theme-toggle-icon-light"></i><i class="fas fa-moon theme-toggle-icon-dark"></i> Toggle Theme
            </a>

            <div class="border-top border-secondary pt-2 pb-0 mb-0" style="position: absolute; bottom: 0; left: 0; width: 100%; background: inherit;">
                <a href="{{ route('admin.logout') }}" class="text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Admin Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="modal_id" value="profileModal">
                    <div class="modal-body">
                        @if ($errors->any() && old('modal_id') == 'profileModal')
                            <div class="alert alert-danger small shadow-sm">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="text-center mb-4">
                            <img id="profileAvatar"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->name) }}&background=0D8ABC&color=fff"
                                class="rounded-circle shadow-sm" width="90" height="90" alt="Avatar" />
                        </div>

                        <div class="mb-3">
                            <label for="profileName" class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" name="name" id="profileName" class="form-control" value="{{ Auth::guard('admin')->user()->name }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="profileEmail" class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" name="email" id="profileEmail" class="form-control"
                                value="{{ Auth::guard('admin')->user()->email }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="profilePhone" class="form-label text-muted small fw-bold d-flex justify-content-between align-items-center mb-1">
                                <span>Phone Number</span>
                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                            </label>
                            <input type="text" name="phone" id="profilePhone" class="form-control admin-profile-phone-input" value="{{ Auth::guard('admin')->user()->phone }}" required inputmode="tel" maxlength="20" placeholder="+8801XXXXXXXXX" />
                            <div class="admin-profile-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                <i class="fas fa-exclamation-circle me-1"></i>Letters and symbols are not allowed in phone number!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profileRole" class="form-label text-muted small fw-bold">Role</label>
                            @php
                                $adminRoleVal = Auth::guard('admin')->user()->role ?? null;
                                $displayRole = ($adminRoleVal === 0 || $adminRoleVal === '0') ? 'Super Admin' : (($adminRoleVal === 1 || $adminRoleVal === '1') ? 'Admin' : ($adminRoleVal ?? 'Super Admin'));
                            @endphp
                            <input type="text" id="profileRole" class="form-control" value="{{ $displayRole }}"
                                readonly />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Account Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.profile.password') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="modal_id" value="settingsModal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label text-muted small fw-bold">Current Password</label>
                            <div class="input-group admin-password-group">
                                <input type="password" name="current_password" id="currentPassword" class="form-control border-end-0"
                                    placeholder="Enter current password" required autocomplete="new-password" />
                                <button class="btn password-toggle-btn border border-start-0" type="button" id="toggleCurrentPassword"
                                    onclick="toggleAdminPasswordVisibility('currentPassword', 'currentPasswordIcon')"
                                    title="Show/Hide Password" aria-label="Toggle password visibility">
                                    <i class="fas fa-eye-slash" id="currentPasswordIcon"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label text-muted small fw-bold">New Password</label>
                            <div class="input-group admin-password-group">
                                <input type="password" name="new_password" id="newPassword" class="form-control border-end-0"
                                    placeholder="Enter new password" required autocomplete="new-password" />
                                <button class="btn password-toggle-btn border border-start-0" type="button" id="toggleNewPassword"
                                    onclick="toggleAdminPasswordVisibility('newPassword', 'newPasswordIcon')"
                                    title="Show/Hide Password" aria-label="Toggle password visibility">
                                    <i class="fas fa-eye-slash" id="newPasswordIcon"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label text-muted small fw-bold">Confirm New Password</label>
                            <div class="input-group admin-password-group">
                                <input type="password" name="new_password_confirmation" id="confirmPassword" class="form-control border-end-0"
                                    placeholder="Confirm new password" required autocomplete="new-password" />
                                <button class="btn password-toggle-btn border border-start-0" type="button" id="toggleConfirmPassword"
                                    onclick="toggleAdminPasswordVisibility('confirmPassword', 'confirmPasswordIcon')"
                                    title="Show/Hide Password" aria-label="Toggle password visibility">
                                    <i class="fas fa-eye-slash" id="confirmPasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div style="position:fixed;bottom:20px;right:20px;z-index:1040;">
        <a href="{{ url('/') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="btn btn-success rounded-pill shadow">
            <i class="fas fa-globe me-2"></i> Live
        </a>
    </div>
    </div>
</div>
    <script src="{{ asset('assets/admin') }}/js/app.js"></script>
    <script src="{{ asset('assets/admin') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin') }}/js/admin-dark-mode.js"></script>

    @if(session('profile_success'))
        <div id="global-profile-alert" style="display: none;" class="alert alert-success alert-dismissible fade show shadow-sm mt-3 mx-3 mx-md-4 mb-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('profile_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var alertEl = document.getElementById('global-profile-alert');
                var mainContainer = document.querySelector('.main-content');
                if (mainContainer && alertEl) {
                    alertEl.style.display = 'block';
                    mainContainer.insertBefore(alertEl, mainContainer.children[1] || mainContainer.firstChild);
                }
            });
        </script>
    @endif

    @if(session('cache_success'))
        <div id="global-cache-alert" style="display: none;" class="alert alert-success alert-dismissible fade show shadow-sm mt-3 mx-3 mx-md-4 mb-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('cache_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var alertEl = document.getElementById('global-cache-alert');
                var mainContainer = document.querySelector('.main-content');
                if (mainContainer && alertEl) {
                    alertEl.style.display = 'block';
                    mainContainer.insertBefore(alertEl, mainContainer.children[1] || mainContainer.firstChild);
                }
            });
        </script>
    @endif



    @if(old('modal_id'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() {
                    var modalId = '{{ old('modal_id') }}';
                    var modalEl = document.getElementById(modalId);
                    if(modalEl) {
                        var modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                }, 500);
            });
        </script>
    @endif
    <script>
        
        (function() {
            var keepAliveInterval = 10 * 60 * 1000;

            function pingServer() {
                fetch('/admin/dashboard', {
                    method: 'HEAD',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                }).catch(function() {
                });
            }

            setInterval(pingServer, keepAliveInterval);

            document.addEventListener('visibilitychange', function() {
                if (!document.hidden) {
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    document.querySelectorAll('input[name="_token"]').forEach(function(input) {
                        input.value = token;
                    });
                }
            });
        })();
    </script>
    <style>
        @keyframes adminProfileShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
        .admin-profile-phone-shake {
            animation: adminProfileShake 0.3s ease-in-out;
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }
        body[data-theme="dark"] .admin-profile-phone-alert {
            color: #f87171 !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var profilePhoneInput = document.getElementById('profilePhone');
            if (!profilePhoneInput) return;

            var alertNotice = profilePhoneInput.parentElement.querySelector('.admin-profile-phone-alert');
            var alertTimeout = null;

            function showWarning() {
                if (alertNotice) alertNotice.classList.remove('d-none');
                profilePhoneInput.classList.add('admin-profile-phone-shake');
                clearTimeout(alertTimeout);
                alertTimeout = setTimeout(function() {
                    profilePhoneInput.classList.remove('admin-profile-phone-shake');
                    if (alertNotice) alertNotice.classList.add('d-none');
                }, 2800);
            }

            function sanitize() {
                var raw = profilePhoneInput.value;
                var cleaned = raw.replace(/[^0-9+\-]/g, '');
                if (raw !== cleaned) {
                    profilePhoneInput.value = cleaned;
                    showWarning();
                }
            }

            profilePhoneInput.addEventListener('input', sanitize);
            profilePhoneInput.addEventListener('blur', sanitize);

            profilePhoneInput.addEventListener('keypress', function(e) {
                var char = String.fromCharCode(e.which || e.keyCode);
                if (!/[0-9+\-]/.test(char) && e.which !== 0 && e.which !== 8 && e.which !== 13) {
                    e.preventDefault();
                    showWarning();
                }
            });

            profilePhoneInput.addEventListener('paste', function(e) {
                var pasted = (e.clipboardData || window.clipboardData).getData('text');
                if (/[^0-9+\-]/.test(pasted)) {
                    e.preventDefault();
                    var filtered = pasted.replace(/[^0-9+\-]/g, '');
                    var start = profilePhoneInput.selectionStart || 0;
                    var end = profilePhoneInput.selectionEnd || 0;
                    var current = profilePhoneInput.value;
                    profilePhoneInput.value = (current.substring(0, start) + filtered + current.substring(end)).slice(0, 20);
                    showWarning();
                }
            });
        });
        document.addEventListener('submit', function(e) {
            var form = e.target;
            if (!form || form.tagName !== 'FORM') return;
            if (form.method && form.method.toUpperCase() === 'GET') return;
            if (form.getAttribute('data-submitting') === 'true') {
                e.preventDefault();
                return false;
            }
            form.setAttribute('data-submitting', 'true');
            var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]') || document.activeElement;
            if (submitBtn && (submitBtn.type === 'submit' || submitBtn.tagName === 'BUTTON')) {
                var origWidth = submitBtn.offsetWidth;
                if (origWidth) {
                    submitBtn.style.minWidth = origWidth + 'px';
                }
                var textSpan = submitBtn.querySelector('.btn-text');
                if (textSpan) {
                    textSpan.textContent = 'Saving...';
                } else if (!submitBtn.querySelector('.spinner-border')) {
                    var currentText = submitBtn.innerText.trim();
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> ' + (currentText ? currentText : 'Saving...');
                }
                submitBtn.style.pointerEvents = 'none';
                submitBtn.style.opacity = '0.75';
                setTimeout(function() {
                    submitBtn.disabled = true;
                }, 50);
            }
        }, true);

        function toggleAdminPasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            if (!passwordInput || !passwordIcon) return;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }
        }

        // Global Custom Alert Modal Function for Admin Panel (Consistent with Registration Modal)
        function showCustomAlert(title, message, iconClass) {
            const titleEl = document.getElementById('customAlertTitle');
            const messageEl = document.getElementById('customAlertMessage');
            const iconEl = document.getElementById('customAlertIcon');
            const modalEl = document.getElementById('customAlertModal');

            if (titleEl) titleEl.innerText = title || 'Alert';
            if (messageEl) messageEl.innerHTML = message ? message.replace(/\n/g, '<br>') : '';
            if (iconEl && iconClass) {
                iconEl.className = iconClass + ' me-2';
            }

            if (modalEl && typeof bootstrap !== 'undefined') {
                const alertModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl, {
                    backdrop: true,
                    keyboard: true
                });

                alertModal.show();
            } else if (modalEl) {
                // If bootstrap is still initializing, display modal directly without native alert
                modalEl.style.display = 'block';
                modalEl.classList.add('show');
            } else {
                console.warn('[CustomAlert]:', title, message);
            }
        }
    </script>

    <!-- Global Custom Alert Modal (Matching Registration Modal & Dark/Light Theme) -->
    <style>
        #customAlertModal {
            z-index: 10600 !important;
        }
        .modal-backdrop.custom-alert-backdrop {
            z-index: 10550 !important;
        }
    </style>
    <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom-0 pb-0">
                    <h6 class="modal-title fw-bold" id="customAlertModalLabel">
                        <i id="customAlertIcon" class="fas fa-exclamation-triangle text-warning me-2"></i><span id="customAlertTitle">Alert</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3 pb-3 text-center">
                    <p id="customAlertMessage" class="mb-0 text-muted" style="font-size: 14px; line-height: 1.5;"></p>
                </div>
                <div class="modal-footer border-top-0 pt-0 justify-content-center pb-3">
                    <button type="button" class="btn btn-primary rounded-pill px-4 btn-sm" data-bs-dismiss="modal">OK, Got it</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alertEl = document.getElementById('customAlertModal');
            if (alertEl) {
                alertEl.addEventListener('show.bs.modal', function() {
                    setTimeout(function() {
                        var backdrops = document.querySelectorAll('.modal-backdrop');
                        if (backdrops.length > 0) {
                            backdrops[backdrops.length - 1].classList.add('custom-alert-backdrop');
                        }
                    }, 10);
                });
                alertEl.addEventListener('hidden.bs.modal', function() {
                    // If another modal is still open, ensure body has modal-open class
                    if (document.querySelectorAll('.modal.show').length > 0) {
                        document.body.classList.add('modal-open');
                    }
                });
            }
        });
    </script>
</body>

</html>