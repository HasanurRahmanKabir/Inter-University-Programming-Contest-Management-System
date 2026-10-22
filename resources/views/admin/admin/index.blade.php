@extends('admin.layout.admin')

@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">System Administrators</h5>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                            id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()->name) }}&background=0D8ABC&color=fff" alt="Admin"
                                class="rounded-circle me-2" width="40" height="40">
                            <span class="fw-medium d-none d-sm-inline">{{ Auth::guard('admin')->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" style="background: none; border: none; width: 100%; text-align: left;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong class="mb-0">Please fix the following errors:</strong>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Manage Admins</h4>
                    <p class="text-muted small mb-0">Create and Manage Admin Accounts.</p>
                </div>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                    <i class="fas fa-user-plus me-2"></i> Add New Admin
                </button>
            </div>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin Info</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $data)
                                <tr>
                                    <td>{{ $data->admin_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($data->name) }}"
                                                class="admin-avatar me-2" alt="Avatar">
                                            <div>
                                                <div class="fw-bold">{{ $data->name }}</div>
                                                <small class="text-muted">{{ $data->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->phone }}</td>
                                    <td class="text-nowrap">
                                        @if ($data->role == 1)
                                            <span class="badge bg-secondary text-white px-2 py-1 rounded-pill fw-medium">Admin</span>
                                        @elseif($data->role == 0)
                                            <span class="badge bg-dark text-white px-2 py-1 rounded-pill fw-medium">Super Admin</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span
                                            class="badge rounded-pill px-3
                                                {{ $data->status == 1 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="text-end text-nowrap">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAdminModal{{ $data->admin_id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteAdminModal{{ $data->admin_id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Create New Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="modal_id" value="addAdminModal">
                        
                        @if ($errors->any() && old('modal_id') == 'addAdminModal')
                            <div class="alert alert-danger small shadow-sm">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your full name"
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email address"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold d-flex justify-content-between align-items-center mb-1">
                                <span>Phone Number</span>
                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2 admin-phone-badge" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                            </label>
                            <input type="text" class="form-control admin-phone-input @error('phone') is-invalid @enderror" 
                                name="phone" 
                                placeholder="Enter phone number (+8801XXXXXXXXX)" 
                                value="{{ old('phone') }}" 
                                pattern="^[0-9+\-]+$"
                                inputmode="tel"
                                maxlength="20"
                                title="Only digits (0-9), +, and - are allowed.">
                            <div class="admin-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                            </div>
                            <div class="invalid-feedback client-admin-phone-feedback d-none">Only digits (0-9), +, and - are allowed.</div>
                            @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <div class="input-group admin-password-group">
                                <input type="password" class="form-control border-end-0" id="createAdminPassword" name="pass"
                                    placeholder="Enter a secure password" required>
                                <button class="btn password-toggle-btn border border-start-0" type="button" id="toggleCreateAdminPassword" onclick="toggleAdminPasswordVisibility('createAdminPassword', 'createAdminPasswordIcon')" title="Show/Hide Password" aria-label="Toggle password visibility">
                                    <i class="fas fa-eye-slash" id="createAdminPasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Role</label>
                            <select class="form-select" name="role">
                                <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
                                <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Super Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Create Account</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    @foreach ($admin as $data)
        <div class="modal fade" id="editAdminModal{{ $data->admin_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Admin Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form action="{{ route('admin.update', $data->admin_id) }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="modal_id" value="editAdminModal{{ $data->admin_id }}">
                            
                            @if ($errors->any() && old('modal_id') == 'editAdminModal' . $data->admin_id)
                                <div class="alert alert-danger small shadow-sm">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Full Name</label>
                                <input type="text" id="editAdminName" class="form-control"
                                    placeholder="Enter full name" value="{{ old('full_name', $data->name) }}" name="full_name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Email Address</label>
                                <input type="email" id="editAdminEmail" class="form-control"
                                    placeholder="Enter email address" value="{{ old('email', $data->email) }}" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="editAdminPhone{{ $data->admin_id }}" class="form-label text-muted small fw-bold d-flex justify-content-between align-items-center mb-1">
                                    <span>Edit Phone Number</span>
                                    <span class="badge bg-light text-secondary border fw-normal py-1 px-2 admin-phone-badge" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                                </label>
                                <input type="text" id="editAdminPhone{{ $data->admin_id }}" 
                                    class="form-control admin-phone-input @error('phone') is-invalid @enderror"
                                    placeholder="Enter phone number (+8801XXXXXXXXX)" 
                                    value="{{ old('phone', $data->phone) }}" 
                                    name="phone"
                                    pattern="^[0-9+\-]+$"
                                    inputmode="tel"
                                    maxlength="20"
                                    title="Only digits (0-9), +, and - are allowed.">
                                <div class="admin-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                </div>
                                <div class="invalid-feedback client-admin-phone-feedback d-none">Only digits (0-9), +, and - are allowed.</div>
                                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Update Password <span class="text-secondary fw-normal">(Optional)</span></label>
                                <div class="input-group admin-password-group">
                                    <input type="password" id="editAdminPassword{{ $data->admin_id }}" class="form-control border-end-0"
                                        placeholder="Leave blank to keep current password" name="pass">
                                    <button class="btn password-toggle-btn border border-start-0" type="button" id="toggleEditAdminPassword{{ $data->admin_id }}" onclick="toggleAdminPasswordVisibility('editAdminPassword{{ $data->admin_id }}', 'editAdminPasswordIcon{{ $data->admin_id }}')" title="Show/Hide Password" aria-label="Toggle password visibility">
                                        <i class="fas fa-eye-slash" id="editAdminPasswordIcon{{ $data->admin_id }}"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select id="editAdminStatus" class="form-select"
                                    name="status">
                                    <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Update Admin</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

        <!-- Delete Admin Modal -->
        <div class="modal fade" id="deleteAdminModal{{ $data->admin_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-4">
                        <div class="text-danger mb-3">
                            <i class="fas fa-exclamation-circle fa-4x opacity-75"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Delete Admin?</h5>
                        <p class="text-muted mb-4">Are you sure you want to delete the admin <strong>"{{ $data->name }}"</strong>? This action cannot be undone.</p>
                        
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ url('/admin/dashboard/delete/' . $data->admin_id) }}" method="post" class="m-0">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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

        @keyframes subtleAdminInputShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
        .admin-phone-shake {
            animation: subtleAdminInputShake 0.3s ease-in-out;
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }
        body[data-theme="dark"] .admin-phone-alert {
            color: #f87171 !important;
        }
        body[data-theme="dark"] label .admin-phone-badge {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
    </style>

    <script>
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

        document.addEventListener('DOMContentLoaded', function() {
            // Admin Phone Validation (Digits, +, and - only with instant UX feedback)
            document.querySelectorAll('.admin-phone-input').forEach(function(input) {
                const form = input.closest('form');
                const feedback = input.parentElement.querySelector('.client-admin-phone-feedback');
                const alertNotice = input.parentElement.querySelector('.admin-phone-alert');
                let alertTimeout = null;

                function showInvalidWarning() {
                    if (alertNotice) {
                        alertNotice.classList.remove('d-none');
                    }
                    input.classList.add('admin-phone-shake');
                    clearTimeout(alertTimeout);
                    alertTimeout = setTimeout(function() {
                        input.classList.remove('admin-phone-shake');
                        if (alertNotice) {
                            alertNotice.classList.add('d-none');
                        }
                    }, 2800);
                }

                function sanitizeAndValidate() {
                    const originalVal = input.value;
                    const cleanedVal = originalVal.replace(/[^0-9+\-]/g, '');
                    if (originalVal !== cleanedVal) {
                        input.value = cleanedVal;
                        showInvalidWarning();
                    }

                    const trimmed = input.value.trim();
                    const isValid = trimmed === '' || /^[0-9+\-]+$/.test(trimmed);
                    if (!isValid && trimmed.length > 0) {
                        input.classList.add('is-invalid');
                        if (feedback) feedback.classList.remove('d-none');
                        input.setCustomValidity('Phone number must contain only digits (0-9), +, and -');
                    } else {
                        input.classList.remove('is-invalid');
                        if (feedback) feedback.classList.add('d-none');
                        input.setCustomValidity('');
                    }
                    return isValid;
                }

                input.addEventListener('input', sanitizeAndValidate);
                input.addEventListener('blur', sanitizeAndValidate);

                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which || e.keyCode);
                    if (!/[0-9+\-]/.test(char) && e.which !== 0 && e.which !== 8 && e.which !== 13) {
                        e.preventDefault();
                        showInvalidWarning();
                    }
                });

                input.addEventListener('paste', function(e) {
                    const pastedData = (e.clipboardData || window.clipboardData).getData('text');
                    if (/[^0-9+\-]/.test(pastedData)) {
                        e.preventDefault();
                        const filteredData = pastedData.replace(/[^0-9+\-]/g, '');
                        const start = input.selectionStart;
                        const end = input.selectionEnd;
                        const currentVal = input.value;
                        const newVal = currentVal.substring(0, start) + filteredData + currentVal.substring(end);
                        input.value = newVal.slice(0, 20);
                        sanitizeAndValidate();
                        showInvalidWarning();
                    }
                });

                if (form) {
                    form.addEventListener('submit', function(e) {
                        const val = input.value.trim();
                        if (val.length > 0 && !/^[0-9+\-]+$/.test(val)) {
                            e.preventDefault();
                            input.classList.add('is-invalid');
                            if (feedback) feedback.classList.remove('d-none');
                            showInvalidWarning();
                            input.focus();
                        }
                    });
                }
            });
        });

        // Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }
        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }
    </script>
@endsection

