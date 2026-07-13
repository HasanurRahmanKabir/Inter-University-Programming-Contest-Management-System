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
                                                class="admin-avatar px-2">
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
                            <label class="form-label text-muted small fw-bold">Phone Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter your phone number" value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" class="form-control" name="pass"
                                placeholder="Enter a secure password" required>
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
                                <label class="form-label text-muted small fw-bold">Edit Phone Number</label>
                                <input type="text" id="editAdminPhone" class="form-control"
                                    placeholder="Enter phone number" value="{{ old('phone', $data->phone) }}" name="phone">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Update Password <span class="text-secondary fw-normal">(Optional)</span></label>
                                <input type="password" id="editAdminPassword" class="form-control"
                                    placeholder="Leave blank to keep current password" name="pass">
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
    <script>
        // Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        toggleBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    </script>
@endsection

