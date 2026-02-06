<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUBIUPC - Premium Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/style.css">
</head>

<body>
    <div class="overlay" id="overlay"></div>

    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4 class="fw-bold mb-0 text-white">
                SUBIUPC <span style="color: #3b82f6">Panel</span>
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
            <a class="{{ Request::is('admin/dashboard/rules_admin') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/rules_admin') }}"><i class="fas fa-clipboard-list"></i> Rules</a>
            <a class="{{ Request::is('admin/dashboard/admin') ? 'active' : '' }}"
                href=" {{ url('admin/dashboard/admin') }}"><i class="fas fa-user-cog"></i> Admins</a>

            <div class="mt-5 border-top border-secondary pt-3">
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
                <div class="modal-body">
                    <form>
                        <div class="text-center mb-3">
                            <img id="profileAvatar"
                                src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff"
                                class="rounded-circle mb-2" width="90" height="90" alt="Avatar" />
                            <div class="small text-muted">
                                Change avatar by uploading a new image
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profileName" class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" id="profileName" class="form-control" value="kamal Hasan" />
                        </div>

                        <div class="mb-3">
                            <label for="profileEmail" class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" id="profileEmail" class="form-control"
                                value="kamalhasan124@gmail.com" />
                        </div>

                        <div class="mb-3">
                            <label for="profilePhone" class="form-label text-muted small fw-bold">Phone Number</label>
                            <input type="text" id="profilePhone" class="form-control" value="01789559698" />
                        </div>

                        <div class="mb-3">
                            <label for="profileRole" class="form-label text-muted small fw-bold">Role</label>
                            <input type="text" id="profileRole" class="form-control" value="Super Admin"
                                readonly />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary px-4">
                        Save Profile
                    </button>
                </div>
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
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label text-muted small fw-bold">Current
                                Password</label>
                            <input type="password" id="currentPassword" class="form-control"
                                placeholder="Enter current password" />
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label text-muted small fw-bold">New Password</label>
                            <input type="password" id="newPassword" class="form-control"
                                placeholder="Enter new password" />
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label text-muted small fw-bold">Confirm New
                                Password</label>
                            <input type="password" id="confirmPassword" class="form-control"
                                placeholder="Confirm new password" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary px-4">
                        Save Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('content/admin') }}/js/app.js"></script>
    <script src="{{ asset('content/admin') }}/js/bootstrap.bundle.min.js"></script>
</body>

</html>
