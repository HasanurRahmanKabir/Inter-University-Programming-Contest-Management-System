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
                <div class="modal-header border-0 pb-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="modal-title fw-bold mb-0">Create New Contest</h5>
                        <button type="button" class="btn btn-sm btn-light border text-primary rounded-circle shadow-sm" style="width: 24px; height: 24px; padding: 0; display: flex; align-items: center; justify-content: center;" data-bs-toggle="collapse" data-bs-target="#addContestGuide" aria-expanded="false" title="Click for instructions">
                            <i class="fas fa-info" style="font-size: 11px;"></i>
                        </button>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="collapse mb-4" id="addContestGuide">
                        <div class="w-100" style="overflow-x: auto; -ms-overflow-style: none; scrollbar-width: none;">
                            <div class="guide-block bg-white rounded-4 shadow-sm border position-relative overflow-hidden w-100" style="border-left: 4px solid #3b82f6 !important; padding: 1.25rem; box-sizing: border-box; min-width: 280px;">
                            <!-- Decorative Background Element -->
                            <div class="position-absolute top-0 end-0 p-3" style="pointer-events: none; opacity: 0.05;">
                                <i class="fas fa-lightbulb" style="font-size: 5rem; color: #3b82f6; transform: rotate(15deg);"></i>
                            </div>
                            
                            <h6 class="fw-bold text-dark mb-4 d-flex align-items-center position-relative z-1" style="font-size: 1.05rem;">
                                <div class="icon-box text-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 36px; height: 36px; background-color: rgba(13, 110, 253, 0.1);">
                                    <i class="fas fa-book" style="font-size: 0.9rem;"></i>
                                </div>
                                Contest Setup Guide (Must Read)
                            </h6>
                            
                            <div class="row g-4 position-relative z-1">
                                <!-- Rule 1 -->
                                <div class="col-md-12">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas fa-calendar-check text-success" style="font-size: 1.1rem;"></i>
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <h6 class="fw-bold mb-2 text-dark" style="font-size: 0.95rem;">1. Registration Date <span class="badge text-success ms-2 fw-semibold border border-success" style="letter-spacing: 0.5px; background-color: rgba(25, 135, 84, 0.1);">CONTROLS HOMEPAGE</span></h6>
                                            <div class="small text-muted" style="line-height: 1.7;">
                                                <div class="mb-2 d-flex align-items-start">
                                                    <i class="fas fa-play text-success mt-1 me-2 flex-shrink-0" style="font-size: 0.65rem; opacity: 0.75;"></i>
                                                    <div><strong class="text-dark">Start Date:</strong> The exact time when teams can start registering. Before this, the registration system remains closed.</div>
                                                </div>
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-stop text-danger mt-1 me-2 flex-shrink-0" style="font-size: 0.65rem; opacity: 0.75;"></i>
                                                    <div><strong class="text-dark">End Date:</strong> When registration permanently closes. Once passed, the <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">Countdown Timer stops</span> and the <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Register Now" button</span> along with the <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Registered Teams" page</span> will automatically vanish from the website.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rule 2 -->
                                <div class="col-md-12">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas fa-flag-checkered text-warning" style="font-size: 1.1rem;"></i>
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <h6 class="fw-bold mb-1 text-dark" style="font-size: 0.95rem;">2. Contest Date</h6>
                                            <div class="small text-muted mt-1" style="line-height: 1.6;">
                                                This is the date of the actual programming event. It should be after registration ends. This date <em class="text-dark fw-medium border-bottom border-dark">does not</em> affect the homepage timer.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rule 3 -->
                                <div class="col-md-12">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas fa-toggle-on text-primary" style="font-size: 1.1rem;"></i>
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <h6 class="fw-bold mb-2 text-dark" style="font-size: 0.95rem;">3. Status (Active/Inactive)</h6>
                                            <div class="small text-muted" style="line-height: 1.7;">
                                                <div class="mb-2 d-flex align-items-start">
                                                    <i class="fas fa-check-circle text-primary mt-1 me-2 flex-shrink-0" style="font-size: 0.8rem; opacity: 0.75;"></i>
                                                    <div><strong class="text-dark">Active:</strong> This contest will go live on the website.</div>
                                                </div>
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-times-circle text-danger mt-1 me-2 flex-shrink-0" style="font-size: 0.8rem; opacity: 0.75;"></i>
                                                    <div><strong class="text-dark">Inactive:</strong> The contest is completely hidden. The <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">Homepage Countdown Timer</span>, <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Register Now" button</span> and <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Registered Teams" page</span> will immediately disappear from the entire website!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

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
                    <div class="modal-header border-0 pb-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="modal-title fw-bold mb-0">Edit Contest Info</h5>
                            <button type="button" class="btn btn-sm btn-light border text-primary rounded-circle shadow-sm" style="width: 24px; height: 24px; padding: 0; display: flex; align-items: center; justify-content: center;" data-bs-toggle="collapse" data-bs-target="#editContestGuide{{ $data->contest_id }}" aria-expanded="false" title="Click for instructions">
                                <i class="fas fa-info" style="font-size: 11px;"></i>
                            </button>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="collapse mb-4" id="editContestGuide{{ $data->contest_id }}">
                            <div class="w-100" style="overflow-x: auto; -ms-overflow-style: none; scrollbar-width: none;">
                                <div class="guide-block bg-white rounded-4 shadow-sm border position-relative overflow-hidden w-100" style="border-left: 4px solid #3b82f6 !important; padding: 1.25rem; box-sizing: border-box; min-width: 280px;">
                                <!-- Decorative Background Element -->
                                <div class="position-absolute top-0 end-0 p-3" style="pointer-events: none; opacity: 0.05;">
                                    <i class="fas fa-lightbulb" style="font-size: 5rem; color: #3b82f6; transform: rotate(15deg);"></i>
                                </div>
                                
                                <h6 class="fw-bold text-dark mb-4 d-flex align-items-center position-relative z-1" style="font-size: 1.05rem;">
                                    <div class="icon-box text-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 36px; height: 36px; background-color: rgba(13, 110, 253, 0.1);">
                                        <i class="fas fa-book" style="font-size: 0.9rem;"></i>
                                    </div>
                                    Contest Setup Guide (Must Read)
                                </h6>
                                
                                <div class="row g-4 position-relative z-1">
                                    <!-- Rule 1 -->
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-shrink-0 mt-1">
                                                <i class="fas fa-calendar-check text-success" style="font-size: 1.1rem;"></i>
                                            </div>
                                            <div class="ms-3 flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-dark" style="font-size: 0.95rem;">1. Registration Date <span class="badge text-success ms-2 fw-semibold border border-success" style="letter-spacing: 0.5px; background-color: rgba(25, 135, 84, 0.1);">CONTROLS HOMEPAGE</span></h6>
                                                <div class="small text-muted" style="line-height: 1.7;">
                                                    <div class="mb-2 d-flex align-items-start">
                                                        <i class="fas fa-play text-success mt-1 me-2 flex-shrink-0" style="font-size: 0.65rem; opacity: 0.75;"></i>
                                                        <div><strong class="text-dark">Start Date:</strong> The exact time when teams can start registering. Before this, the registration system remains closed.</div>
                                                    </div>
                                                    <div class="d-flex align-items-start">
                                                        <i class="fas fa-stop text-danger mt-1 me-2 flex-shrink-0" style="font-size: 0.65rem; opacity: 0.75;"></i>
                                                        <div><strong class="text-dark">End Date:</strong> When registration permanently closes. Once passed, the <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">Countdown Timer stops</span> and the <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Register Now" button</span> along with the <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Registered Teams" page</span> will automatically vanish from the website.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rule 2 -->
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-shrink-0 mt-1">
                                                <i class="fas fa-flag-checkered text-warning" style="font-size: 1.1rem;"></i>
                                            </div>
                                            <div class="ms-3 flex-grow-1">
                                                <h6 class="fw-bold mb-1 text-dark" style="font-size: 0.95rem;">2. Contest Date</h6>
                                                <div class="small text-muted mt-1" style="line-height: 1.6;">
                                                    This is the date of the actual programming event. It should be after registration ends. This date <em class="text-dark fw-medium border-bottom border-dark">does not</em> affect the homepage timer.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rule 3 -->
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-shrink-0 mt-1">
                                                <i class="fas fa-toggle-on text-primary" style="font-size: 1.1rem;"></i>
                                            </div>
                                            <div class="ms-3 flex-grow-1">
                                                <h6 class="fw-bold mb-2 text-dark" style="font-size: 0.95rem;">3. Status (Active/Inactive)</h6>
                                                <div class="small text-muted" style="line-height: 1.7;">
                                                    <div class="mb-2 d-flex align-items-start">
                                                        <i class="fas fa-check-circle text-primary mt-1 me-2 flex-shrink-0" style="font-size: 0.8rem; opacity: 0.75;"></i>
                                                        <div><strong class="text-dark">Active:</strong> This contest will go live on the website.</div>
                                                    </div>
                                                    <div class="d-flex align-items-start">
                                                        <i class="fas fa-times-circle text-danger mt-1 me-2 flex-shrink-0" style="font-size: 0.8rem; opacity: 0.75;"></i>
                                                        <div><strong class="text-dark">Inactive:</strong> The contest is completely hidden. The <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">Homepage Countdown Timer</span>, <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Register Now" button</span> and <span class="text-danger fw-semibold" style="background-color: rgba(220, 53, 69, 0.08); padding: 2px 6px; border-radius: 4px;">"Registered Teams" page</span> will immediately disappear from the entire website!</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

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
