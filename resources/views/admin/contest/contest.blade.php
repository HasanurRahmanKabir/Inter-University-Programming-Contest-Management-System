@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 text-secondary">Contest Management</h5>
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
            </div>
        </nav>

        <div class="container-fluid p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0 text-dark">All Contests Information</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContestModal">
                    <i class="fas fa-plus me-2"></i> Add New Contest
                </button>
            </div>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="width: 25%;">Title & Description</th>
                                <th>Contest Schedule</th>
                                <th>Registration Schedule</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contest as $data)
                                <tr>
                                    <td>{{ $data->contest_id }}</td>
                                    <td>
                                        <div class="fw-bold text-primary">{{ $data->title }}</div>
                                        <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                            {{ $data->description }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="small"><i class="far fa-calendar-alt me-1 text-muted"></i>
                                            {{ $data->contest_start_date }}</div>
                                        <div class="small"><i class="far fa-flag me-1 text-muted"></i>
                                            {{ $data->contest_end_date }}</div>
                                    </td>
                                    <td>
                                        <div class="small"><i class="far fa-clock me-1 text-muted"></i>
                                            {{ $data->registration_start_date }}</div>
                                        <div class="small"><i class="far fa-times-circle me-1 text-muted"></i>
                                            {{ $data->registration_end_date }}
                                        </div>
                                    </td>

                                    <td>
                                        <span
                                            class="badge 
                                {{ $data->status ? 'bg-success bg-opacity-10 text-white' : 'bg-danger bg-opacity-10 text-white' }} 
                                px-3 py-2 rounded-pill">

                                            {{ $data->status ? 'Active' : 'Inactive' }}

                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editContestModal{{ $data->contest_id }}" title="Edit"><i
                                                class="fas fa-edit"></i></button>
                                        <form action="{{ url('/admin/dashboard/contest/delete/' . $data->contest_id) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-light btn-sm text-danger"
                                                onclick="return confirm('Are you sure you want to delete this contest?')"
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

    <!-- Add Contest Modal -->
    <div class="modal fade" id="addContestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Create New Contest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/dashboard/contest/store') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Contest Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter contest title"
                                    required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Description</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Enter contest details..."></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Contest Start Date</label>
                                <input type="datetime-local" name="contest_start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Contest End Date</label>
                                <input type="datetime-local" name="contest_end_date" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Registration Start Date</label>
                                <input type="datetime-local" name="registration_start_date" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Registration End Date</label>
                                <input type="datetime-local" name="registration_end_date" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1" selected>Active (Visible to users)</option>
                                    <option value="0">Inactive (Hidden)</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Save Contest</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Contest Modal -->

    @foreach ($contest as $data)
        <div class="modal fade" id="editContestModal{{ $data->contest_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Edit Contest Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.contest.update', $data->contest_id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="editContestTitle" class="form-label text-muted small fw-bold">Edit Contest
                                        Title</label>
                                    <input type="text" id="editContestTitle" class="form-control"
                                        placeholder="Enter contest title" value="{{ $data->title }}" name="title"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <label for="editContestDescription" class="form-label text-muted small fw-bold">Edit
                                        Description</label>
                                    <textarea id="editContestDescription" class="form-control" rows="3" placeholder="Enter contest details..."
                                        name="description">{{ $data->description }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="editContestStart" class="form-label text-muted small fw-bold">Edit Contest
                                        Start
                                        Date</label>
                                    <input type="datetime-local" id="editContestStart" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($data->contest_start_date)->format('Y-m-d\TH:i') }}"
                                        name="contest_start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="editContestEnd" class="form-label text-muted small fw-bold">Edit Contest
                                        End
                                        Date</label>
                                    <input type="datetime-local" id="editContestEnd" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($data->contest_end_date)->format('Y-m-d\TH:i') }}"
                                        name="contest_end_date" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="editRegStart" class="form-label text-muted small fw-bold">Edit
                                        Registration
                                        Start Date</label>
                                    <input type="datetime-local" id="editRegStart" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($data->registration_start_date)->format('Y-m-d\TH:i') }}"
                                        name="registration_start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="editRegEnd" class="form-label text-muted small fw-bold">Edit Registration
                                        End
                                        Date</label>
                                    <input type="datetime-local" id="editRegEnd" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($data->registration_end_date)->format('Y-m-d\TH:i') }}"
                                        name="registration_end_date" required>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label text-muted small fw-bold">Status</label>
                                    <select class="form-select" value="{{ $data->status }}" name="status">
                                        <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active (Visible
                                            to users)</option>
                                        <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive
                                            (Hidden)
                                        </option>
                                    </select>

                                </div>
                            </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Update Contest</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script>
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

    </body>
@endsection
