@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Volunteer Management</h5>

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

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
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
                            @forelse ($volunteer as $data)
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
                                            class="badge {{ $data->status ? 'bg-success bg-opacity-10 text-white' : 'bg-danger text-white' }} rounded-pill px-3">{{ $data->status ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-info" data-bs-toggle="modal"
                                            data-bs-target="#noticeModal{{ $data->volunteer_id }}" title="Edit Notice"><i
                                                class="fas fa-comment-alt"></i></button>
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#editVolunteerModal{{ $data->volunteer_id }}"
                                            title="Edit Info"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-light btn-sm text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteVolunteerModal{{ $data->volunteer_id }}" title="Delete"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="fas fa-users-slash mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="fw-bold mb-1">No volunteers found</h5>
                                        <p class="mb-0 small">There are no volunteers added to the system yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    {{ $volunteer->appends(request()->query())->links('pagination::bootstrap-5') }}
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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Set default password" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
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
                            <input type="hidden" name="volunteer_notice" value="{{ $data->volunteer_notice }}">
                            <div class="mb-3">
                                <label for="editVolunteerName" class="form-label text-muted small fw-bold">Edit Full
                                    Name</label>
                                <input type="text" id="editVolunteerName" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter full name" value="{{ old('name', $data->name) }}" name="name" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editVolunteerEmail" class="form-label text-muted small fw-bold">Edit Email
                                    Address</label>
                                <input type="email" id="editVolunteerEmail" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter email address" value="{{ old('email', $data->email) }}" name="email" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editVolunteerPhone" class="form-label text-muted small fw-bold">Edit Phone
                                    Number</label>
                                <input type="text" id="editVolunteerPhone" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter phone number" value="{{ old('phone', $data->phone) }}" name="phone" required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="editVolunteerStatus"
                                    class="form-label text-muted small fw-bold">Status</label>
                                <select id="editVolunteerStatus" class="form-select" name="status">
                                    <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Inactive</option>
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

        <div class="modal fade" id="noticeModal{{ $data->volunteer_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Assign Task / Notice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.volunteer.update', $data->volunteer_id) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="name" value="{{ $data->name }}">
                        <input type="hidden" name="email" value="{{ $data->email }}">
                        <input type="hidden" name="phone" value="{{ $data->phone }}">
                        <input type="hidden" name="status" value="{{ $data->status }}">
                        <div class="modal-body">
                            <div class="alert alert-primary d-flex align-items-center small" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <div>This message will be visible on the volunteer's dashboard.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Volunteer Name</label>
                                <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Special Instruction
                                    (volunteer_notice)</label>
                                <textarea name="volunteer_notice" class="form-control" rows="4"
                                    placeholder="Ex: Report to Room 204 at 8:00 AM for kit distribution duty...">{{ $data->volunteer_notice }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info text-white px-4">Update Notice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($volunteer as $data)
        <!-- Delete Volunteer Modal -->
        <div class="modal fade" id="deleteVolunteerModal{{ $data->volunteer_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-4">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-circle text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Are you sure?</h4>
                        <p class="text-muted mb-4">You are about to delete volunteer <strong>{{ $data->name }}</strong>.<br>This action cannot be undone.</p>
                        
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button type="button" class="btn btn-light px-4 text-nowrap" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ url('/admin/dashboard/volunteer/delete/' . $data->volunteer_id) }}" method="post" class="m-0">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger px-4 text-nowrap">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

