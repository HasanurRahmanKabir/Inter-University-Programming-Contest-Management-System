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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/admin-dark-mode.css">
</head>

<body>
<div class="flex min-h-screen">

    <div class="overlay" id="overlay"></div>

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0 text-white">
                Admin <span style="color: #3b82f6">Panel</span>
            </h4>
        </div>
        <div class="sidebar-menu">
            <a class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}"><i
                    class="fas fa-th-large"></i> Dashboard</a>
            <a class="{{ Request::is('admin/dashboard/contest') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/contest') }}"><i class="fas fa-trophy"></i> Contests</a>
            <a class="{{ Request::is('admin/dashboard/team') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/team') }}"><i class="fas fa-users"></i> Teams</a>

            <a class="{{ Request::is('admin/dashboard/payment') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/payment') }}"><i class="fas fa-credit-card"></i> Payments</a>
            <a class="{{ Request::is('admin/dashboard/volunteer') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/volunteer') }}"><i class="fas fa-hand-holding-heart"></i> Volunteers</a>
            <a class="{{ Request::is('admin/dashboard/notice') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/notice') }}"><i class="fas fa-bullhorn"></i> Notices</a>
            <a class="{{ Request::is('admin/dashboard/gallery') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/gallery') }}"><i class="fas fa-images"></i> Gallery</a>
            <a class="{{ Request::is('admin/dashboard/kitstatus') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/kitstatus') }}"><i class="fas fa-gift"></i> Kit Status</a>
            <a class="{{ Request::is('admin/dashboard/sponsor') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/sponsor') }}"><i class="fas fa-ad"></i> Sponsors</a>
            <a class="{{ Request::is('admin/dashboard/downloaddetails') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/downloaddetails') }}"><i class="fas fa-download fa-lg me-2"></i>
                Download Details</a>
            <a class="{{ Request::is('admin/dashboard/rules') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/rules') }}"><i class="fas fa-clipboard-list"></i> Rules</a>
            <a class="{{ Request::is('admin/dashboard/admin') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/admin') }}"><i class="fas fa-user-cog"></i> Admins</a>
            <a class="{{ Request::is('admin/dashboard/website-settings') ? 'active' : '' }}" 
                href="{{ url('admin/dashboard/website-settings') }}">
                <i class="fas fa-cogs"></i> Website Settings</a>    

            <!-- Theme Toggle -->
            <a href="#" class="theme-toggle-btn w-100 text-start ps-3 py-2 mt-2" style="border-radius: 8px;">
                <i class="fas fa-lightbulb theme-toggle-icon-light"></i>
                <i class="fas fa-moon theme-toggle-icon-dark"></i>
                <span class="ms-2">Toggle Theme</span>
            </a>

            <div class="mt-4 border-top border-secondary pt-3">
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
                        <div class="text-center mb-3">
                            <img id="profileAvatar"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->name) }}&background=0D8ABC&color=fff"
                                class="rounded-circle mb-2" width="90" height="90" alt="Avatar" />
                            <div class="small text-muted">
                                Avatar is generated from your name
                            </div>
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
                            <label for="profilePhone" class="form-label text-muted small fw-bold">Phone Number</label>
                            <input type="text" name="phone" id="profilePhone" class="form-control" value="{{ Auth::guard('admin')->user()->phone }}" required />
                        </div>

                        <div class="mb-3">
                            <label for="profileRole" class="form-label text-muted small fw-bold">Role</label>
                            <input type="text" id="profileRole" class="form-control" value="{{ Auth::guard('admin')->user()->role ?? 'Super Admin' }}"
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
                        @if ($errors->any() && old('modal_id') == 'settingsModal')
                            <div class="alert alert-danger small shadow-sm">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label text-muted small fw-bold">Current Password</label>
                            <input type="password" name="current_password" id="currentPassword" class="form-control"
                                placeholder="Enter current password" required autocomplete="new-password" />
                            @error('current_password')
                                <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label text-muted small fw-bold">New Password</label>
                            <input type="password" name="new_password" id="newPassword" class="form-control"
                                placeholder="Enter new password" required autocomplete="new-password" />
                            @error('new_password')
                                <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label text-muted small fw-bold">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="confirmPassword" class="form-control"
                                placeholder="Confirm new password" required autocomplete="new-password" />
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


    <div style="position:fixed;bottom:20px;right:20px;z-index:9999;">
        <a href="{{ url('/') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="btn btn-success rounded-pill shadow">
            <i class="fas fa-globe me-2"></i> Live
        </a>
    </div>
</div>
    <script src="{{ asset('content/admin') }}/js/app.js"></script>
    <script src="{{ asset('content/admin') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('content/admin') }}/js/admin-dark-mode.js"></script>

    @if(session('profile_success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-4 shadow-lg" style="z-index: 9999;" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>Success!</strong> {{ session('profile_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
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
</body>

</html>