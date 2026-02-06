@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Team Management</h5>

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
                <div class="col-md-2 d-flex align-items-stretch">
                    <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-search me-2"></i>
                        Search
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
                            @foreach ($teamregistration as $data)
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
                                            class="badge bg-primary bg-opacity-10 text-white">{{ $data->is_selected ? 'Selected' : 'Not Selected' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                            data-bs-target="#teamDetailModal{{ $data->team_id }}"><i
                                                class="fas fa-eye"></i>
                                            Details</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="mt-4">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
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
                                            <input type="file" class="form-control form-control-sm w-50 mx-auto mt-1"
                                                name="coach_photo" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="small text-muted fw-bold">Team Name</label>
                                        <input type="text" class="form-control" name="team_name"
                                            value="{{ $data->team_name }}">
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="small text-muted">Institute Name</label>
                                            <input type="text" class="form-control" name="institute_name"
                                                value="{{ $data->institute_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Coach Name</label>
                                            <input type="text" class="form-control" name="coach_name"
                                                value="{{ $data->coach_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Coach Email</label>
                                            <input type="email" class="form-control" name="coach_email"
                                                value="{{ $data->coach_email }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small text-muted">Emergency Contact</label>
                                            <input type="text" class="form-control" name="coach_phone"
                                                value="{{ $data->coach_phone }}">
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
                                            <input type="file" class="form-control form-control-sm mt-2"
                                                name="mem_1_photo" accept="image/*">
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center">Member 01</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted">Name</label>
                                            <input type="text" class="form-control form-control-sm" name="mem_1_name"
                                                value="{{ $data->mem_1_name }}">
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
                                            <input type="file" class="form-control form-control-sm mt-2"
                                                name="mem_2_photo" accept="image/*">
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center">Member 02</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted">Name</label>
                                            <input type="text" class="form-control form-control-sm" name="mem_2_name"
                                                value="{{ $data->mem_2_name }}">
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
                                            <input type="file" class="form-control form-control-sm mt-2"
                                                name="mem_3_photo" accept="image/*">
                                        </div>
                                        <h6 class="fw-bold mb-2 text-center">Member 03</h6>
                                        <div class="mb-2">
                                            <label class="small text-muted">Name</label>
                                            <input type="text" class="form-control form-control-sm" name="mem_3_name"
                                                value="{{ $data->mem_3_name }}">
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
                                    <div class="row g-2 align-items-center">
                                        <div class="col-md-4">
                                            
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="selectCheck{{ $data->team_id }}" name="is_selected"
                                                    value="1" {{ $data->is_selected ? 'checked' : '' }}>
                                                <label class="form-check-label" for="selectCheck{{ $data->team_id }}">
                                                    Team Selected
                                                </label>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0 p-0">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 

                        <hr>


                        <form action="{{ url('/admin/dashboard/team/delete/' . $data->team_id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this team?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete Team
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        (function() {
            // Sidebar Logic
            const sb = document.getElementById('sidebar');
            const ov = document.getElementById('overlay');
            const tgl = document.getElementById('sidebarToggle');

            function toggleSidebar() {
                if (sb) sb.classList.toggle('active');
                if (ov) ov.classList.toggle('active');
            }

            if (tgl) tgl.addEventListener('click', toggleSidebar);
            if (ov) ov.addEventListener('click', toggleSidebar);

            // Search and Filter Logic (Persist State)
            try {
                var searchForm = document.querySelector('form[action="{{ route('admin.teamregistration.index') }}"]');
                if (searchForm) {
                    searchForm.addEventListener('submit', function() {
                        try {
                            sessionStorage.setItem('teams_searched', '1');
                        } catch (e) {}
                    });
                }
            } catch (e) {}

            try {
                if (window.location.search) {
                    try {
                        history.replaceState(null, '', window.location.pathname + window.location.hash);
                    } catch (e) {}
                }
            } catch (e) {}

            window.addEventListener('pageshow', function(event) {
                try {
                    if (!window.location.search) {
                        var qInput = document.querySelector('input[name="q"]');
                        var filterSelect = document.querySelector('select[name="filter"]');
                        if (qInput) qInput.value = '';
                        if (filterSelect) filterSelect.selectedIndex = 0;
                        try {
                            history.replaceState(null, '', window.location.pathname + window.location.hash);
                        } catch (e) {}
                    }
                } catch (e) {}
            });
        })();
    </script>
@endsection
