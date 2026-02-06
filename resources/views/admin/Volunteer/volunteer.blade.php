@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Volunteer Management</h5>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                            id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Admin"
                                class="rounded-circle me-2" width="40" height="40">
                            <span class="fw-medium d-none d-sm-inline">Admin User</span>
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
                    <h4 class="fw-bold mb-0 text-dark">Volunteers List</h4>
                    <p class="text-muted small mb-0">Manage volunteers and assign notices.</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
                    <i class="fas fa-user-plus me-2"></i> Add Volunteer
                </button>
            </div>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Volunteer Name & Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($volunteer as $data)
                                <tr>
                                    <td>{{ $data->volunteer_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($data->name) }}" alt="Avatar"
                                                class="volunteer-avatar pe-2">
                                            <div>
                                                <div class="fw-bold">{{ $data->name }}</div>
                                                <small class="text-muted">{{ $data->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->phone }}</td>
                                    <td>
                                        <span
                                            class="badge bg-success bg-opacity-10 text-white rounded-pill px-3">{{ $data->status ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-info" data-bs-toggle="modal"
                                            data-bs-target="#noticeModal" title="Edit Notice"><i
                                                class="fas fa-comment-alt"></i></button>
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editVolunteerModal{{ $data->volunteer_id }}"
                                            title="Edit Info"><i class="fas fa-edit"></i></button>
                                        <form action="{{ url('/admin/dashboard/volunteer/delete/'. $data->volunteer_id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                        <button type="submit" class="btn btn-light btn-sm text-danger" onclick="return confirm('Are you sure you want to delete this volunteer?')" title="Delete"><i
                                                class="fas fa-trash"></i></button>
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

    <!-- Add Volunteer Modal -->
    <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add New Volunteer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/dashboard/volunteer/store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter full name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email address"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Phone Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Set default password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Create Account</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="noticeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Assign Task / Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary d-flex align-items-center small" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>This message will be visible on the volunteer's dashboard.</div>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Volunteer Name</label>
                            <input type="text" class="form-control" value="Rahim Mia" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Special Instruction
                                (volunteer_notice)</label>
                            <textarea class="form-control" rows="4"
                                placeholder="Ex: Report to Room 204 at 8:00 AM for kit distribution duty..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info text-white px-4">Update Notice</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Volunteer Modal -->

    @foreach ($volunteer as $data)
        <div class="modal fade" id="editVolunteerModal{{ $data->volunteer_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Volunteer Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('admin.volunteer.update', $data->volunteer_id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="editVolunteerName" class="form-label text-muted small fw-bold">Edit Full
                                    Name</label>
                                <input type="text" id="editVolunteerName" class="form-control"
                                    placeholder="Enter full name" value="{{ $data->name }}" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editVolunteerEmail" class="form-label text-muted small fw-bold">Edit Email
                                    Address</label>
                                <input type="email" id="editVolunteerEmail" class="form-control"
                                    placeholder="Enter email address" value="{{ $data->email }}" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editVolunteerPhone" class="form-label text-muted small fw-bold">Edit Phone
                                    Number</label>
                                <input type="text" id="editVolunteerPhone" class="form-control"
                                    placeholder="Enter phone number" value="{{ $data->phone }}" name="phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="editVolunteerStatus"
                                    class="form-label text-muted small fw-bold">Status</label>
                                <select id="editVolunteerStatus" class="form-select" value="{{ $data->status }}" name="status">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Update Volunteer</button>
                    </div>
                    </form>
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
