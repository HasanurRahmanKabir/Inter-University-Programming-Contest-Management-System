@extends('admin.layout.admin')

@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">System Administrators</h5>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                            id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin" alt="Super Admin" class="rounded-circle me-2"
                                width="40" height="40">
                            <span class="fw-medium d-none d-sm-inline">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#profileModal">Profile</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#settingsModal">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="admin_login.html">Logout</a></li>
                        </ul>
                    </div>
                </div>
        </nav>

        <div class="container-fluid p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
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
                    <table class="table table-hover mb-0">
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
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            @if ($data->role == 1)
                                                Admin
                                            @elseif($data->role == 0)
                                                Super Admin
                                            @endif
                                        </span>
                                    </td>

                                    <td>
                                        <span
                                            class="badge rounded-pill px-3
                                                {{ $data->status == 1 ? 'bg-success bg-opacity-10 text-white' : 'bg-danger bg-opacity-10 text-white' }}">
                                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAdminModal{{ $data->admin_id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ url('/admin/dashboard/delete/' . $data->admin_id) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-light btn-sm text-danger"
                                                onclick="return confirm('Are you sure you want to delete this admin?')"
                                                title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
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
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your full name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email address"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Phone Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter your phone number">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" class="form-control" name="pass"
                                placeholder="Enter a secure password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Role</label>
                            <select class="form-select" name="role">
                                <option value="1" selected>Admin</option>
                                <option value="0">Super Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
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
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Full Name</label>
                                <input type="text" id="editAdminName" class="form-control"
                                    placeholder="Enter full name" value="{{ $data->name }}" name="full_name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Email Address</label>
                                <input type="email" id="editAdminEmail" class="form-control"
                                    placeholder="Enter email address" value="{{ $data->email }}" name="email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Phone Number</label>
                                <input type="text" id="editAdminPhone" class="form-control"
                                    placeholder="Enter phone number" value="{{ $data->phone }}" name="phone">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select id="editAdminStatus" class="form-select" value="{{ $data->status }}"
                                    name="status">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
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
