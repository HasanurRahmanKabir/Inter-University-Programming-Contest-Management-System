@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Team Management</h5>

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
                                    <button type="submit" class="dropdown-item text-danger bg-transparent border-0 w-100 text-start">Logout</button>
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

            <form method="GET" action="{{ route('admin.teamregistration.index') }}" class="row mb-4 g-3">
                <div class="col-md-4">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                        placeholder="Search by Team Name, Institute...">
                </div>

                <div class="col-md-3">
                    <select name="filter" class="form-select">
                        <option value=""
                            {{ request('filter') === null || request('filter') === '' ? 'selected' : '' }}>Filter by
                            Selection</option>
                        <option value="1" {{ request('filter') === '1' ? 'selected' : '' }}>Selected</option>
                        <option value="0" {{ request('filter') === '0' ? 'selected' : '' }}>Not Selected</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-stretch gap-2">
                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-search me-2"></i>
                        Search
                    </button>
                    @if(request()->has('q') || request('filter') !== null)
                    <a href="{{ route('admin.teamregistration.index') }}" class="btn btn-light border w-100 d-flex align-items-center justify-content-center text-decoration-none text-secondary">
                        <i class="fas fa-times me-2"></i>
                        Clear
                    </a>
                    @endif
                </div>
            </form>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Team Name</th>
                                <th>Institute</th>
                                <th>Coach Info</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teamregistration as $data)
                                <tr>
                                    <td>{{ $data->team_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($data->team_name) }}&background=random"
                                                class="team-avatar me-2">
                                            <div>
                                                <div class="fw-bold">{{ $data->team_name }}</div>
                                                <small class="text-muted">3 Members</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->institute_name }}</td>
                                    <td>
                                        <div>{{ $data->coach_name }}</div>
                                        <small class="text-muted">{{ $data->coach_phone }}</small>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $data->is_selected ? 'bg-primary text-white' : 'bg-danger text-white' }} px-3 py-2 rounded-pill">{{ $data->is_selected ? 'Selected' : 'Not Selected' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#teamDetailModal{{ $data->team_id }}"><i
                                                class="fas fa-eye"></i>
                                            Details</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fas fa-users-slash mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="fw-bold mb-1">No teams found</h5>
                                        <p class="mb-0 small">No teams match your current search criteria.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4 d-flex justify-content-end">
                    {{ $teamregistration->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    
    @foreach ($teamregistration as $data)
        <div class="modal fade" id="teamDetailModal{{ $data->team_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Team Details: <span
                                class="text-primary">{{ $data->team_name }}</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light">

                        
                        <form action="{{ url('/admin/dashboard/team/update/' . $data->team_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white fw-bold">Coach & Institute Information</div>
                                <div class="card-body">
                                    
                                    <div class="row mb-3">
                                        <div class="col-12 text-center">
                                            <div class="mb-2">
                                                <img src="{{ !empty($data->coach_photo) && file_exists(public_path($data->coach_photo)) ? asset($data->coach_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($data->coach_name) }}"
                                                    class="rounded-circle border shadow-sm"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <label class="small text-muted fw-bold">Coach Photo</label>
                                            <input type="file" class="form-control form-control-sm w-50 mx-auto mt-1 @error('coach_photo') is-invalid @enderror"
                                                name="coach_photo" accept="image/*">
                                            @error('coach_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="small text-muted fw-bold">Team Name</label>
                                        <input type="text" class="form-control @error('team_name') is-invalid @enderror" name="team_name"
                                            value="{{ old('team_name', $data->team_name) }}">
                                        @error('team_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="small text-muted">Institute Name</label>
                                            <input type="text" class="form-control @error('institute_name') is-invalid @enderror" name="institute_name"
                                                value="{{ old('institute_name', $data->institute_name) }}">
                                            @error('institute_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Coach Name</label>
                                            <input type="text" class="form-control @error('coach_name') is-invalid @enderror" name="coach_name"
                                                value="{{ old('coach_name', $data->coach_name) }}">
                                            @error('coach_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Coach Email</label>
                                            <input type="email" class="form-control @error('coach_email') is-invalid @enderror" name="coach_email"
                                                value="{{ old('coach_email', $data->coach_email) }}">
                                            @error('coach_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Emergency Contact</label>
                                            <input type="text" class="form-control @error('coach_phone') is-invalid @enderror" name="coach_phone"
                                                value="{{ old('coach_phone', $data->coach_phone) }}">
                                            @error('coach_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Team T-Shirt Requirement</label>
                                            <input type="text" class="form-control bg-light" value="3 Pieces"
                                                readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Coach T-Shirt Size</label>
                                            <select class="form-select" name="coach_t_shirt">
                                                <option value="S"
                                                    {{ $data->coach_t_shirt == 'S' ? 'selected' : '' }}>
                                                    S</option>
                                                <option value="M"
                                                    {{ $data->coach_t_shirt == 'M' ? 'selected' : '' }}>
                                                    M</option>
                                                <option value="L"
                                                    {{ $data->coach_t_shirt == 'L' ? 'selected' : '' }}>
                                                    L</option>
                                                <option value="XL"
                                                    {{ $data->coach_t_shirt == 'XL' ? 'selected' : '' }}>XL</option>
                                                <option value="XXL"
                                                    {{ $data->coach_t_shirt == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 ms-1">Team Members</h6>
                            <div class="row g-3">
                                
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm p-3 h-100">
                                        <div class="text-center mb-2">
                                            <img src="{{ !empty($data->mem_1_photo) && file_exists(public_path($data->mem_1_photo)) ? asset($data->mem_1_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($data->mem_1_name) }}"
                                                class="member-card-img mx-auto"
                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                            <input type="file" class="form-control form-control-sm mt-2 @error('mem_1_photo') is-invalid @enderror"
                                                name="mem_1_photo" accept="image/*">
                                            @error('mem_1_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center">Member 01</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted">Name</label>
                                            <input type="text" class="form-control form-control-sm @error('mem_1_name') is-invalid @enderror" name="mem_1_name"
                                                value="{{ old('mem_1_name', $data->mem_1_name) }}">
                                            @error('mem_1_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="small text-muted">Size</label>
                                            <select class="form-select form-select-sm" name="mem_1_t_shirt">
                                                <option value="S"
                                                    {{ $data->mem_1_t_shirt == 'S' ? 'selected' : '' }}>S</option>
                                                <option value="M"
                                                    {{ $data->mem_1_t_shirt == 'M' ? 'selected' : '' }}>M</option>
                                                <option value="L"
                                                    {{ $data->mem_1_t_shirt == 'L' ? 'selected' : '' }}>L</option>
                                                <option value="XL"
                                                    {{ $data->mem_1_t_shirt == 'XL' ? 'selected' : '' }}>XL</option>
                                                <option value="XXL"
                                                    {{ $data->mem_1_t_shirt == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm p-3 h-100">
                                        <div class="text-center mb-2">
                                            <img src="{{ !empty($data->mem_2_photo) && file_exists(public_path($data->mem_2_photo)) ? asset($data->mem_2_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($data->mem_2_name) }}"
                                                class="member-card-img mx-auto"
                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                            <input type="file" class="form-control form-control-sm mt-2 @error('mem_2_photo') is-invalid @enderror"
                                                name="mem_2_photo" accept="image/*">
                                            @error('mem_2_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center">Member 02</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted">Name</label>
                                            <input type="text" class="form-control form-control-sm @error('mem_2_name') is-invalid @enderror" name="mem_2_name"
                                                value="{{ old('mem_2_name', $data->mem_2_name) }}">
                                            @error('mem_2_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="small text-muted">Size</label>
                                            <select class="form-select form-select-sm" name="mem_2_t_shirt">
                                                <option value="S"
                                                    {{ $data->mem_2_t_shirt == 'S' ? 'selected' : '' }}>S</option>
                                                <option value="M"
                                                    {{ $data->mem_2_t_shirt == 'M' ? 'selected' : '' }}>M</option>
                                                <option value="L"
                                                    {{ $data->mem_2_t_shirt == 'L' ? 'selected' : '' }}>L</option>
                                                <option value="XL"
                                                    {{ $data->mem_2_t_shirt == 'XL' ? 'selected' : '' }}>XL</option>
                                                <option value="XXL"
                                                    {{ $data->mem_2_t_shirt == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm p-3 h-100">
                                        <div class="text-center mb-2">
                                            <img src="{{ !empty($data->mem_3_photo) && file_exists(public_path($data->mem_3_photo)) ? asset($data->mem_3_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($data->mem_3_name) }}"
                                                class="member-card-img mx-auto"
                                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                            <input type="file" class="form-control form-control-sm mt-2 @error('mem_3_photo') is-invalid @enderror"
                                                name="mem_3_photo" accept="image/*">
                                            @error('mem_3_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center">Member 03</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted">Name</label>
                                            <input type="text" class="form-control form-control-sm @error('mem_3_name') is-invalid @enderror" name="mem_3_name"
                                                value="{{ old('mem_3_name', $data->mem_3_name) }}">
                                            @error('mem_3_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="small text-muted">Size</label>
                                            <select class="form-select form-select-sm" name="mem_3_t_shirt">
                                                <option value="S"
                                                    {{ $data->mem_3_t_shirt == 'S' ? 'selected' : '' }}>S</option>
                                                <option value="M"
                                                    {{ $data->mem_3_t_shirt == 'M' ? 'selected' : '' }}>M</option>
                                                <option value="L"
                                                    {{ $data->mem_3_t_shirt == 'L' ? 'selected' : '' }}>L</option>
                                                <option value="XL"
                                                    {{ $data->mem_3_t_shirt == 'XL' ? 'selected' : '' }}>XL</option>
                                                <option value="XXL"
                                                    {{ $data->mem_3_t_shirt == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="card border-0 shadow-sm mt-4 border-warning border-start border-4">
                                <div class="card-body">
                                    <h6 class="fw-bold">Admin Actions</h6>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input @error('is_selected') is-invalid @enderror" type="checkbox"
                                            id="selectCheck{{ $data->team_id }}" name="is_selected"
                                            value="1" {{ old('is_selected', $data->is_selected) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="selectCheck{{ $data->team_id }}">
                                            Team Selected
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    <div class="modal-footer d-flex justify-content-between align-items-center bg-white border-top">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTeamModal{{ $data->team_id }}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Team Modal -->
        <div class="modal fade" id="deleteTeamModal{{ $data->team_id }}" tabindex="-1" aria-hidden="true">
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
                        <p class="text-muted mb-4">You are about to delete team <strong>{{ $data->team_name }}</strong>.<br>This action cannot be undone.</p>
                        
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button type="button" class="btn btn-light px-4 text-nowrap" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ url('/admin/dashboard/team/delete/' . $data->team_id) }}" method="post" class="m-0">
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

