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

            @php
                $hasFilter = request()->filled('q') || (request()->has('filter') && request('filter') !== '' && request('filter') !== null);
            @endphp
            <form method="GET" action="{{ route('admin.teamregistration.index') }}" class="row mb-4 g-2" id="teamFilterForm">
                <div class="col-md-5 col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="q" id="teamSearchInput" value="{{ request('q') }}" class="form-control border-start-0"
                            placeholder="Search by Team Name, Institute, Coach...">
                    </div>
                </div>

                <div class="col-md-3 col-12">
                    <select name="filter" id="teamFilterSelect" class="form-select">
                        <option value="" {{ request('filter') === null || request('filter') === '' ? 'selected' : '' }}>Filter by Selection</option>
                        <option value="1" {{ request('filter') === '1' ? 'selected' : '' }}>Selected</option>
                        <option value="0" {{ request('filter') === '0' ? 'selected' : '' }}>Not Selected</option>
                    </select>
                </div>

                <div class="col-md-2 col-6">
                    <button type="submit" id="teamSearchBtn" class="btn btn-primary w-100 d-flex align-items-center justify-content-center" title="Search">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                </div>

                <div class="col-md-2 col-6">
                    <button type="button" id="teamResetBtn"
                        class="btn btn-light border w-100 d-flex align-items-center justify-content-center team-reset-btn {{ !$hasFilter ? 'is-disabled' : '' }}"
                        title="{{ $hasFilter ? 'Clear All Filters' : 'No filters applied' }}"
                        {{ !$hasFilter ? 'disabled' : '' }}>
                        <i class="fas fa-sync-alt text-muted me-2"></i> Clear
                    </button>
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

                        
                        <form action="{{ route('team.update', $data->team_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="modal_id" value="teamDetailModal{{ $data->team_id }}">
                            
                            @if ($errors->any() && old('modal_id') == 'teamDetailModal' . $data->team_id)
                                <div class="alert alert-danger small shadow-sm">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white fw-bold">Coach & Institute Information</div>
                                <div class="card-body">
                                    
                                    <div class="row mb-3">
                                        <div class="col-12 text-center">
                                            @php
                                                $hasCoachPhoto = !empty($data->coach_photo) && file_exists(public_path($data->coach_photo));
                                                $coachAvatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($data->coach_name) . '&background=0D8ABC&color=fff';
                                                $coachImgSrc = $hasCoachPhoto ? asset($data->coach_photo) : $coachAvatarUrl;
                                            @endphp
                                            <div class="d-inline-block position-relative mb-2 admin-photo-wrapper">
                                                <img src="{{ $coachImgSrc }}"
                                                    id="coachPhotoPreview{{ $data->team_id }}"
                                                    data-default="{{ $coachAvatarUrl }}"
                                                    class="rounded-circle border shadow-sm admin-team-photo-img"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                <button type="button" 
                                                    class="admin-photo-remove-btn {{ $hasCoachPhoto ? '' : 'd-none' }}" 
                                                    id="coachPhotoRemoveBtn{{ $data->team_id }}"
                                                    title="Remove Coach Photo"
                                                    onclick="removeAdminTeamPhoto('{{ $data->team_id }}', 'coach')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="remove_coach_photo" id="remove_coach_photo_{{ $data->team_id }}" value="0">
                                            <label class="small text-muted fw-bold d-block">Coach Photo</label>
                                            <input type="file" 
                                                class="form-control form-control-sm mx-auto mt-1 @error('coach_photo') is-invalid @enderror"
                                                style="max-width: 260px;"
                                                name="coach_photo" 
                                                id="coach_photo_input_{{ $data->team_id }}"
                                                accept="image/jpeg,image/png,image/jpg,image/webp,image/avif,image/heic,image/heif"
                                                onchange="previewAdminTeamPhoto(this, 'coachPhotoPreview{{ $data->team_id }}', 'coachPhotoRemoveBtn{{ $data->team_id }}', 'remove_coach_photo_{{ $data->team_id }}')">
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
                                            <label class="small text-muted d-flex justify-content-between align-items-center mb-1">
                                                <span>Emergency Contact</span>
                                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                                            </label>
                                            <input type="text" class="form-control emergency-contact-input @error('coach_phone') is-invalid @enderror" 
                                                name="coach_phone"
                                                id="coach_phone_{{ $data->team_id }}"
                                                value="{{ old('coach_phone', $data->coach_phone) }}"
                                                pattern="^[0-9+\-]+$"
                                                inputmode="tel"
                                                maxlength="20"
                                                placeholder="+8801XXXXXXXXX"
                                                title="Only digits (0-9), +, and - are allowed."
                                                required>
                                            <div class="emergency-contact-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                            </div>
                                            @error('coach_phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
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
                                            @php
                                                $hasMem1Photo = !empty($data->mem_1_photo) && file_exists(public_path($data->mem_1_photo));
                                                $mem1AvatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($data->mem_1_name) . '&background=0D8ABC&color=fff';
                                                $mem1ImgSrc = $hasMem1Photo ? asset($data->mem_1_photo) : $mem1AvatarUrl;
                                            @endphp
                                            <div class="d-inline-block position-relative admin-photo-wrapper">
                                                <img src="{{ $mem1ImgSrc }}"
                                                    id="mem1PhotoPreview{{ $data->team_id }}"
                                                    data-default="{{ $mem1AvatarUrl }}"
                                                    class="member-card-img mx-auto admin-team-photo-img"
                                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                                <button type="button" 
                                                    class="admin-photo-remove-btn admin-photo-remove-btn-sm {{ $hasMem1Photo ? '' : 'd-none' }}" 
                                                    id="mem1PhotoRemoveBtn{{ $data->team_id }}"
                                                    title="Remove Member 01 Photo"
                                                    onclick="removeAdminTeamPhoto('{{ $data->team_id }}', 'mem_1')">
                                                    <i class="fas fa-times"></i>
                                                 </button>
                                            </div>
                                            <input type="hidden" name="remove_mem_1_photo" id="remove_mem_1_photo_{{ $data->team_id }}" value="0">
                                            <input type="file" 
                                                class="form-control form-control-sm mt-2 @error('mem_1_photo') is-invalid @enderror"
                                                name="mem_1_photo" 
                                                id="mem_1_photo_input_{{ $data->team_id }}"
                                                accept="image/jpeg,image/png,image/jpg,image/webp,image/avif,image/heic,image/heif"
                                                onchange="previewAdminTeamPhoto(this, 'mem1PhotoPreview{{ $data->team_id }}', 'mem1PhotoRemoveBtn{{ $data->team_id }}', 'remove_mem_1_photo_{{ $data->team_id }}')">
                                            @error('mem_1_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center text-primary">Member 01</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('mem_1_name') is-invalid @enderror" name="mem_1_name"
                                                value="{{ old('mem_1_name', $data->mem_1_name) }}" required>
                                            @error('mem_1_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Student ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('mem_1_student_id') is-invalid @enderror" name="mem_1_student_id"
                                                value="{{ old('mem_1_student_id', $data->mem_1_student_id) }}" required>
                                            @error('mem_1_student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-sm @error('mem_1_email') is-invalid @enderror" name="mem_1_email"
                                                value="{{ old('mem_1_email', $data->mem_1_email) }}" required>
                                            @error('mem_1_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold d-flex justify-content-between align-items-center mb-1">
                                                <span>Phone</span>
                                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                                            </label>
                                            <input type="text" class="form-control form-control-sm emergency-contact-input @error('mem_1_phone') is-invalid @enderror" name="mem_1_phone"
                                                value="{{ old('mem_1_phone', $data->mem_1_phone) }}"
                                                pattern="^[0-9+\-]*$"
                                                inputmode="tel"
                                                maxlength="20"
                                                placeholder="+8801XXXXXXXXX"
                                                title="Only digits (0-9), +, and - are allowed.">
                                            <div class="emergency-contact-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                            </div>
                                            @error('mem_1_phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="small text-muted fw-bold">Size</label>
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
                                            @php
                                                $hasMem2Photo = !empty($data->mem_2_photo) && file_exists(public_path($data->mem_2_photo));
                                                $mem2AvatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($data->mem_2_name) . '&background=0D8ABC&color=fff';
                                                $mem2ImgSrc = $hasMem2Photo ? asset($data->mem_2_photo) : $mem2AvatarUrl;
                                            @endphp
                                            <div class="d-inline-block position-relative admin-photo-wrapper">
                                                <img src="{{ $mem2ImgSrc }}"
                                                    id="mem2PhotoPreview{{ $data->team_id }}"
                                                    data-default="{{ $mem2AvatarUrl }}"
                                                    class="member-card-img mx-auto admin-team-photo-img"
                                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                                <button type="button" 
                                                    class="admin-photo-remove-btn admin-photo-remove-btn-sm {{ $hasMem2Photo ? '' : 'd-none' }}" 
                                                    id="mem2PhotoRemoveBtn{{ $data->team_id }}"
                                                    title="Remove Member 02 Photo"
                                                    onclick="removeAdminTeamPhoto('{{ $data->team_id }}', 'mem_2')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="remove_mem_2_photo" id="remove_mem_2_photo_{{ $data->team_id }}" value="0">
                                            <input type="file" 
                                                class="form-control form-control-sm mt-2 @error('mem_2_photo') is-invalid @enderror"
                                                name="mem_2_photo" 
                                                id="mem_2_photo_input_{{ $data->team_id }}"
                                                accept="image/jpeg,image/png,image/jpg,image/webp,image/avif,image/heic,image/heif"
                                                onchange="previewAdminTeamPhoto(this, 'mem2PhotoPreview{{ $data->team_id }}', 'mem2PhotoRemoveBtn{{ $data->team_id }}', 'remove_mem_2_photo_{{ $data->team_id }}')">
                                            @error('mem_2_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center text-primary">Member 02</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('mem_2_name') is-invalid @enderror" name="mem_2_name"
                                                value="{{ old('mem_2_name', $data->mem_2_name) }}" required>
                                            @error('mem_2_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Student ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('mem_2_student_id') is-invalid @enderror" name="mem_2_student_id"
                                                value="{{ old('mem_2_student_id', $data->mem_2_student_id) }}" required>
                                            @error('mem_2_student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-sm @error('mem_2_email') is-invalid @enderror" name="mem_2_email"
                                                value="{{ old('mem_2_email', $data->mem_2_email) }}" required>
                                            @error('mem_2_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold d-flex justify-content-between align-items-center mb-1">
                                                <span>Phone</span>
                                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                                            </label>
                                            <input type="text" class="form-control form-control-sm emergency-contact-input @error('mem_2_phone') is-invalid @enderror" name="mem_2_phone"
                                                value="{{ old('mem_2_phone', $data->mem_2_phone) }}"
                                                pattern="^[0-9+\-]*$"
                                                inputmode="tel"
                                                maxlength="20"
                                                placeholder="+8801XXXXXXXXX"
                                                title="Only digits (0-9), +, and - are allowed.">
                                            <div class="emergency-contact-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                            </div>
                                            @error('mem_2_phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="small text-muted fw-bold">Size</label>
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
                                            @php
                                                $hasMem3Photo = !empty($data->mem_3_photo) && file_exists(public_path($data->mem_3_photo));
                                                $mem3AvatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($data->mem_3_name) . '&background=0D8ABC&color=fff';
                                                $mem3ImgSrc = $hasMem3Photo ? asset($data->mem_3_photo) : $mem3AvatarUrl;
                                            @endphp
                                            <div class="d-inline-block position-relative admin-photo-wrapper">
                                                <img src="{{ $mem3ImgSrc }}"
                                                    id="mem3PhotoPreview{{ $data->team_id }}"
                                                    data-default="{{ $mem3AvatarUrl }}"
                                                    class="member-card-img mx-auto admin-team-photo-img"
                                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                                <button type="button" 
                                                    class="admin-photo-remove-btn admin-photo-remove-btn-sm {{ $hasMem3Photo ? '' : 'd-none' }}" 
                                                    id="mem3PhotoRemoveBtn{{ $data->team_id }}"
                                                    title="Remove Member 03 Photo"
                                                    onclick="removeAdminTeamPhoto('{{ $data->team_id }}', 'mem_3')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" name="remove_mem_3_photo" id="remove_mem_3_photo_{{ $data->team_id }}" value="0">
                                            <input type="file" 
                                                class="form-control form-control-sm mt-2 @error('mem_3_photo') is-invalid @enderror"
                                                name="mem_3_photo" 
                                                id="mem_3_photo_input_{{ $data->team_id }}"
                                                accept="image/jpeg,image/png,image/jpg,image/webp,image/avif,image/heic,image/heif"
                                                onchange="previewAdminTeamPhoto(this, 'mem3PhotoPreview{{ $data->team_id }}', 'mem3PhotoRemoveBtn{{ $data->team_id }}', 'remove_mem_3_photo_{{ $data->team_id }}')">
                                            @error('mem_3_photo') <div class="invalid-feedback text-center">{{ $message }}</div> @enderror
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center text-primary">Member 03</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('mem_3_name') is-invalid @enderror" name="mem_3_name"
                                                value="{{ old('mem_3_name', $data->mem_3_name) }}" required>
                                            @error('mem_3_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Student ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm @error('mem_3_student_id') is-invalid @enderror" name="mem_3_student_id"
                                                value="{{ old('mem_3_student_id', $data->mem_3_student_id) }}" required>
                                            @error('mem_3_student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-sm @error('mem_3_email') is-invalid @enderror" name="mem_3_email"
                                                value="{{ old('mem_3_email', $data->mem_3_email) }}" required>
                                            @error('mem_3_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label class="small text-muted fw-bold d-flex justify-content-between align-items-center mb-1">
                                                <span>Phone</span>
                                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                                            </label>
                                            <input type="text" class="form-control form-control-sm emergency-contact-input @error('mem_3_phone') is-invalid @enderror" name="mem_3_phone"
                                                value="{{ old('mem_3_phone', $data->mem_3_phone) }}"
                                                pattern="^[0-9+\-]*$"
                                                inputmode="tel"
                                                maxlength="20"
                                                placeholder="+8801XXXXXXXXX"
                                                title="Only digits (0-9), +, and - are allowed.">
                                            <div class="emergency-contact-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                            </div>
                                            @error('mem_3_phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="small text-muted fw-bold">T-Shirt Size</label>
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
                            <form action="{{ route('admin.team.destroy', $data->team_id) }}" method="post" class="m-0">
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

    <style>
        .team-reset-btn {
            transition: all 0.2s ease;
        }
        .team-reset-btn:disabled,
        .team-reset-btn.is-disabled {
            opacity: 0.55;
            cursor: not-allowed !important;
            pointer-events: auto !important;
        }
        .team-reset-btn:not(:disabled):hover {
            background-color: #f1f5f9;
        }
        .team-reset-btn:not(:disabled):hover i {
            color: #ef4444 !important;
            transform: rotate(-180deg);
            transition: transform 0.3s ease, color 0.2s ease;
        }
        body[data-theme="dark"] .team-reset-btn {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #e2e8f0 !important;
        }
        body[data-theme="dark"] .team-reset-btn i {
            color: #94a3b8 !important;
        }
        body[data-theme="dark"] .team-reset-btn:not(:disabled):hover {
            background-color: #334155 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
        body[data-theme="dark"] .team-reset-btn:not(:disabled):hover i {
            color: #f87171 !important;
        }
        body[data-theme="dark"] .input-group-text.bg-white {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #94a3b8 !important;
        }

        /* Admin Team Photo Removal Button & Wrapper */
        .admin-photo-wrapper {
            display: inline-block;
            position: relative;
        }
        .admin-photo-remove-btn {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #ef4444;
            color: #ffffff;
            border: 2px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
            transition: all 0.2s ease-in-out;
            padding: 0;
            line-height: 1;
        }
        .admin-photo-remove-btn:hover {
            background: #dc2626;
            color: #ffffff;
            transform: scale(1.15);
        }
        .admin-photo-remove-btn-sm {
            width: 22px;
            height: 22px;
            font-size: 10px;
            top: -4px;
            right: -4px;
        }
        body[data-theme="dark"] .admin-photo-remove-btn {
            background: #ef4444;
            color: #ffffff;
            border: 2px solid #1e293b;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }
        body[data-theme="dark"] .admin-photo-remove-btn:hover {
            background: #dc2626;
        }

        /* Mobile Responsive Adjustments for Team Modal Footer */
        @media (max-width: 575.98px) {
            .modal-footer {
                padding: 0.75rem 0.75rem !important;
                gap: 0.5rem !important;
            }
            .modal-footer .btn {
                font-size: 0.85rem !important;
                height: 38px !important;
                min-height: 38px !important;
                max-height: 38px !important;
                padding: 0 0.75rem !important;
                line-height: 1 !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
                box-sizing: border-box !important;
            }
            .modal-footer .btn-primary.px-4 {
                padding-left: 0.85rem !important;
                padding-right: 0.85rem !important;
            }
        }

        /* Emergency Contact Shake & Visual Feedback */
        @keyframes subtleInputShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
        .emergency-input-shake {
            animation: subtleInputShake 0.3s ease-in-out;
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }
        body[data-theme="dark"] .emergency-contact-alert {
            color: #f87171 !important;
        }
        body[data-theme="dark"] label .badge.bg-light {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
    </style>

    <script>
        // Photo Preview for Admin Team Modal
        function previewAdminTeamPhoto(input, previewId, removeBtnId, hiddenRemoveInputId) {
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/avif', 'image/heic', 'image/heif'];
                var validExts = ['.jpg', '.jpeg', '.png', '.webp', '.avif', '.heic', '.heif'];
                var fileName = file.name.toLowerCase();
                var hasValidExt = validExts.some(function(ext) { return fileName.endsWith(ext); });

                if (!validTypes.includes(file.type) && !hasValidExt) {
                    alert('Invalid file format! Only images (JPG, JPEG, PNG, WEBP, AVIF, HEIC) are allowed.');
                    input.value = '';
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('Image size exceeds 2MB limit. Please upload a photo smaller than 2MB.');
                    input.value = '';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function (e) {
                    var preview = document.getElementById(previewId);
                    if (preview) {
                        preview.src = e.target.result;
                    }
                    var removeBtn = document.getElementById(removeBtnId);
                    if (removeBtn) {
                        removeBtn.classList.remove('d-none');
                    }
                    var hiddenInput = document.getElementById(hiddenRemoveInputId);
                    if (hiddenInput) {
                        hiddenInput.value = '0';
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        // Photo Removal for Admin Team Modal
        function removeAdminTeamPhoto(teamId, role) {
            // Support both camelCase and snake_case role (e.g., 'mem_1' or 'mem1')
            var cleanRole = role.replace('_', ''); // e.g., 'mem1', 'mem2', 'mem3', 'coach'
            var snakeRole = role.includes('_') ? role : (role.startsWith('mem') ? 'mem_' + role.replace('mem', '') : role); // e.g., 'mem_1', 'coach'

            var preview = document.getElementById(cleanRole + 'PhotoPreview' + teamId) || 
                          document.getElementById(role + 'PhotoPreview' + teamId);
            var removeBtn = document.getElementById(cleanRole + 'PhotoRemoveBtn' + teamId) || 
                            document.getElementById(role + 'PhotoRemoveBtn' + teamId);
            var fileInput = document.getElementById(snakeRole + '_photo_input_' + teamId) || 
                            document.getElementById(cleanRole + '_photo_input_' + teamId);
            var hiddenInput = document.getElementById('remove_' + snakeRole + '_photo_' + teamId) || 
                              document.getElementById('remove_' + cleanRole + '_photo_' + teamId);

            if (fileInput) {
                fileInput.value = '';
            }
            if (hiddenInput) {
                hiddenInput.value = '1';
            }
            if (preview) {
                var defaultAvatar = preview.getAttribute('data-default');
                if (defaultAvatar) {
                    preview.src = defaultAvatar;
                }
            }
            if (removeBtn) {
                removeBtn.classList.add('d-none');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('teamFilterForm');
            const searchInput = document.getElementById('teamSearchInput');
            const filterSelect = document.getElementById('teamFilterSelect');
            const resetBtn = document.getElementById('teamResetBtn');

            if (!filterForm || !searchInput || !filterSelect || !resetBtn) return;

            const hasActiveUrlFilter = {{ $hasFilter ? 'true' : 'false' }};
            const cleanUrl = "{{ route('admin.teamregistration.index') }}";

            function updateResetButtonState() {
                const hasClientValues = (searchInput.value.trim() !== '') || 
                                        (filterSelect.value !== '');

                if (hasActiveUrlFilter || hasClientValues) {
                    resetBtn.removeAttribute('disabled');
                    resetBtn.classList.remove('is-disabled');
                    resetBtn.setAttribute('title', 'Clear Filters');
                } else {
                    resetBtn.setAttribute('disabled', 'disabled');
                    resetBtn.classList.add('is-disabled');
                    resetBtn.setAttribute('title', 'No filters applied');
                }
            }

            searchInput.addEventListener('input', updateResetButtonState);
            filterSelect.addEventListener('change', updateResetButtonState);

            resetBtn.addEventListener('click', function (e) {
                e.preventDefault();

                if (resetBtn.hasAttribute('disabled')) {
                    return;
                }

                if (hasActiveUrlFilter) {
                    window.location.href = cleanUrl;
                } else {
                    searchInput.value = '';
                    filterSelect.value = '';
                    updateResetButtonState();
                }
            });

            filterForm.addEventListener('submit', function (e) {
                const hasValues = (searchInput.value.trim() !== '') || 
                                  (filterSelect.value !== '');

                if (!hasValues) {
                    e.preventDefault();
                    if (hasActiveUrlFilter) {
                        window.location.href = cleanUrl;
                    }
                    return false;
                }
            });

            updateResetButtonState();

            // Emergency Contact Validation (Digits, +, and - only with instant UX feedback)
            document.querySelectorAll('.emergency-contact-input').forEach(function(input) {
                const form = input.closest('form');
                const feedback = input.parentElement.querySelector('.client-phone-feedback');
                const alertNotice = input.parentElement.querySelector('.emergency-contact-alert');
                let alertTimeout = null;

                function showInvalidWarning() {
                    if (alertNotice) {
                        alertNotice.classList.remove('d-none');
                    }
                    input.classList.add('emergency-input-shake');
                    clearTimeout(alertTimeout);
                    alertTimeout = setTimeout(function() {
                        input.classList.remove('emergency-input-shake');
                        if (alertNotice) {
                            alertNotice.classList.add('d-none');
                        }
                    }, 2800);
                }

                function sanitizeAndValidate(showErrors = true) {
                    const originalVal = input.value;
                    const cleanedVal = originalVal.replace(/[^0-9+\-]/g, '');
                    if (originalVal !== cleanedVal) {
                        input.value = cleanedVal;
                        showInvalidWarning();
                    }

                    const trimmed = input.value.trim();
                    const isRequired = input.hasAttribute('required');
                    
                    if (trimmed.length === 0) {
                        if (isRequired && showErrors) {
                            input.classList.add('is-invalid');
                            input.setCustomValidity('This field is required.');
                            return false;
                        } else {
                            input.classList.remove('is-invalid');
                            input.setCustomValidity('');
                            return true;
                        }
                    }

                    const isValid = /^[0-9+\-]+$/.test(trimmed);
                    if (!isValid) {
                        if (showErrors) {
                            input.classList.add('is-invalid');
                        }
                        input.setCustomValidity('Contact number must contain only digits (0-9), +, and -');
                    } else {
                        input.classList.remove('is-invalid');
                        input.setCustomValidity('');
                    }
                    return isValid;
                }

                input.addEventListener('input', function() {
                    sanitizeAndValidate(true);
                });
                input.addEventListener('blur', function() {
                    sanitizeAndValidate(true);
                });

                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which || e.keyCode);
                    // If not a digit, +, - or special navigation keys
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
                        const isRequired = input.hasAttribute('required');
                        if (val.length === 0 && !isRequired) {
                            return true;
                        }
                        if (!/^[0-9+\-]+$/.test(val)) {
                            e.preventDefault();
                            input.classList.add('is-invalid');
                            if (feedback) feedback.classList.remove('d-none');
                            showInvalidWarning();
                            input.focus();
                            return false;
                        }
                    });
                }
            });
        });
    </script>
@endsection

