@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Contest Management</h5>
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

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center align-items-start gap-3 mb-4">
                <h4 class="fw-bold mb-0 text-dark">All Contests Information</h4>
                <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#addContestModal">
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
                            @forelse ($contest as $data)
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
                                        <button type="button" class="btn btn-light btn-sm text-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteContestModal{{ $data->contest_id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fas fa-box-open mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="fw-bold mb-1">No contests found</h5>
                                        <p class="mb-0 small">Click "Add New Contest" to create one.</p>
                                    </td>
                                </tr>
                            @endforelse
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
                        <input type="hidden" name="modal_id" value="addContestModal">
                        
                        @if ($errors->any() && old('modal_id') == 'addContestModal')
                            <div class="alert alert-danger small shadow-sm">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Contest Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter contest title" value="{{ old('title') }}" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="3" name="description" placeholder="Enter contest details...">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Contest Start Date</label>
                                <input type="datetime-local" name="contest_start_date" class="form-control @error('contest_start_date') is-invalid @enderror" value="{{ old('contest_start_date') }}" required>
                                @error('contest_start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Contest End Date</label>
                                <input type="datetime-local" name="contest_end_date" class="form-control @error('contest_end_date') is-invalid @enderror" value="{{ old('contest_end_date') }}" required>
                                @error('contest_end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Registration Start Date</label>
                                <input type="datetime-local" name="registration_start_date" class="form-control @error('registration_start_date') is-invalid @enderror" value="{{ old('registration_start_date') }}" required>
                                @error('registration_start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Registration End Date</label>
                                <input type="datetime-local" name="registration_end_date" class="form-control @error('registration_end_date') is-invalid @enderror" value="{{ old('registration_end_date') }}" required>
                                @error('registration_end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active (Visible to users)</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive (Hidden)</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <input type="hidden" name="modal_id" value="editContestModal{{ $data->contest_id }}">
                            
                            @if ($errors->any() && old('modal_id') == 'editContestModal' . $data->contest_id)
                                <div class="alert alert-danger small shadow-sm">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="editContestTitle{{ $data->contest_id }}" class="form-label text-muted small fw-bold">Edit Contest Title</label>
                                    <input type="text" id="editContestTitle{{ $data->contest_id }}" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter contest title" value="{{ old('title', $data->title) }}" name="title" required>
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="editContestDescription{{ $data->contest_id }}" class="form-label text-muted small fw-bold">Edit Description</label>
                                    <textarea id="editContestDescription{{ $data->contest_id }}" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter contest details..."
                                        name="description">{{ old('description', $data->description) }}</textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="editContestStart{{ $data->contest_id }}" class="form-label text-muted small fw-bold">Edit Contest Start Date</label>
                                    <input type="datetime-local" id="editContestStart{{ $data->contest_id }}" class="form-control @error('contest_start_date') is-invalid @enderror"
                                        value="{{ old('contest_start_date', \Carbon\Carbon::parse($data->contest_start_date)->format('Y-m-d\TH:i')) }}"
                                        name="contest_start_date" required>
                                    @error('contest_start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="editContestEnd{{ $data->contest_id }}" class="form-label text-muted small fw-bold">Edit Contest End Date</label>
                                    <input type="datetime-local" id="editContestEnd{{ $data->contest_id }}" class="form-control @error('contest_end_date') is-invalid @enderror"
                                        value="{{ old('contest_end_date', \Carbon\Carbon::parse($data->contest_end_date)->format('Y-m-d\TH:i')) }}"
                                        name="contest_end_date" required>
                                    @error('contest_end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="editRegStart{{ $data->contest_id }}" class="form-label text-muted small fw-bold">Edit Registration Start Date</label>
                                    <input type="datetime-local" id="editRegStart{{ $data->contest_id }}" class="form-control @error('registration_start_date') is-invalid @enderror"
                                        value="{{ old('registration_start_date', \Carbon\Carbon::parse($data->registration_start_date)->format('Y-m-d\TH:i')) }}"
                                        name="registration_start_date" required>
                                    @error('registration_start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="editRegEnd{{ $data->contest_id }}" class="form-label text-muted small fw-bold">Edit Registration End Date</label>
                                    <input type="datetime-local" id="editRegEnd{{ $data->contest_id }}" class="form-control @error('registration_end_date') is-invalid @enderror"
                                        value="{{ old('registration_end_date', \Carbon\Carbon::parse($data->registration_end_date)->format('Y-m-d\TH:i')) }}"
                                        name="registration_end_date" required>
                                    @error('registration_end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label text-muted small fw-bold">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active (Visible to users)</option>
                                        <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Inactive (Hidden)</option>
                                    </select>
                                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

        <!-- Delete Contest Modal -->
        <div class="modal fade" id="deleteContestModal{{ $data->contest_id }}" tabindex="-1" aria-hidden="true">
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
                        <p class="text-muted mb-4">You are about to delete <strong>{{ $data->title }}</strong>.<br>This action cannot be undone.</p>
                        
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button type="button" class="btn btn-light px-4 text-nowrap" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ url('/admin/dashboard/contest/delete/' . $data->contest_id) }}" method="post" class="m-0">
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
