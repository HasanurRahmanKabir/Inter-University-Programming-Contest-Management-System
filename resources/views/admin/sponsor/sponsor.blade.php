@extends('admin.layout.admin')
@section('content')
    <div class="main-content">


        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Sponsors & Partners</h5>

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
                    <h4 class="fw-bold mb-0 text-dark">Sponsor List</h4>
                    <p class="text-muted small mb-0">Manage event sponsors and their branding.</p>
                </div>
                <button class="btn btn-primary align-self-stretch align-self-sm-auto" data-bs-toggle="modal" data-bs-target="#addSponsorModal">
                    <i class="fas fa-plus me-2"></i> Add New Sponsor
                </button>
            </div>


            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Logo</th>
                                <th style="width: 20%;">Sponsor Info</th>
                                <th>Status</th>
                                <th style="width: 30%;">Details</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sponsors as $data)
                                <tr>

                                    <td><span class="fw-bold text-secondary">#{{ $data->sponsor_id }}</span></td>


                                    <td>
                                        <div class="bg-white rounded border p-1 d-inline-flex align-items-center justify-content-center shadow-sm"
                                            style="width: 60px; height: 60px; overflow: hidden;">
                                            <img src="{{ !empty($data->logo) && file_exists(public_path($data->logo)) ? asset($data->logo) : 'https://via.placeholder.com/60?text=No+Img' }}"
                                                alt="{{ $data->name }} Logo" class="img-fluid"
                                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        </div>
                                    </td>


                                    <td>
                                        <div class="fw-bold text-dark fs-6">{{ $data->name }}</div>


                                        @if ($data->link)
                                            <a href="{{ $data->link }}" target="_blank"
                                                class="text-decoration-none small text-primary mt-1 d-inline-block">
                                                <i class="fas fa-external-link-alt me-1"></i> Visit Website
                                            </a>
                                        @else
                                            <small class="text-muted fst-italic d-block mt-1">No link provided</small>
                                        @endif


                                        <div class="mt-2">
                                            @if ($data->sponsor_category == 0)
                                                <span class="badge bg-danger">Bronze</span>
                                            @elseif($data->sponsor_category == 1)
                                                <span class="badge bg-secondary">Silver</span>
                                            @elseif($data->sponsor_category == 2)
                                                <span class="badge bg-warning text-dark">Gold</span>
                                            @elseif($data->sponsor_category == 3)
                                                <span class="badge bg-dark">Platinum</span>
                                            @elseif($data->sponsor_category == 4)
                                                <span class="badge bg-primary">Diamond</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        @if ($data->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div style="max-width: 300px;">
                                            @if ($data->details)
                                                <small class="text-muted d-block"
                                                    style="white-space: pre-line; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $data->details }}
                                                </small>
                                                @if (strlen($data->details) > 60)
                                                    <span class="badge bg-light text-secondary border mt-1"
                                                        style="cursor: help;" title="{{ $data->details }}">
                                                        Read More
                                                    </span>
                                                @endif
                                            @else
                                                <span class="text-muted fst-italic small">No details provided</span>
                                            @endif
                                        </div>
                                    </td>


                                    <td class="text-end">
                                        <button class="btn btn-light btn-sm text-primary shadow-sm border"
                                            data-bs-toggle="modal" data-bs-target="#editSponsorModal{{ $data->sponsor_id }}"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-light btn-sm text-danger shadow-sm border ms-1"
                                            data-bs-toggle="modal" data-bs-target="#deleteSponsorModal{{ $data->sponsor_id }}"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Delete Confirmation Modal --}}
                                <div class="modal fade" id="deleteSponsorModal{{ $data->sponsor_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center pb-4">
                                                <div class="text-danger mb-3">
                                                    <i class="fas fa-exclamation-circle fa-4x opacity-75"></i>
                                                </div>
                                                <h5 class="fw-bold text-dark mb-2">Delete Sponsor?</h5>
                                                <p class="text-muted mb-4">Are you sure you want to delete <strong>{{ $data->name }}</strong>? This action cannot be undone and will remove their logo and details permanently.</p>
                                                
                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ url('/admin/dashboard/sponsor/delete/' . $data->sponsor_id) }}" method="post" class="m-0">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-handshake mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="fw-bold mb-1">No Sponsors Found</h5>
                                        <p class="text-muted small mb-0">You have not added any sponsors or partners yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addSponsorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-wrap me-3">Add Sponsor</h5>
                    <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin/dashboard/sponsor/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="modal_id" value="addSponsorModal">
                        
                        @if ($errors->any() && old('modal_id') == 'addSponsorModal')
                            <div class="alert alert-danger small shadow-sm">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Sponsor Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter company name"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Logo Upload</label>
                            <input type="file" name="logo" class="form-control" accept="image/*" required>
                            <div class="form-text small">Recommended size: 200x200px (PNG/JPG)</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Website Link</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-link text-muted"></i></span>
                                <input type="url" class="form-control" name="link"
                                    placeholder="https://example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Category</label>
                            <select class="form-select" name="sponsor_category">
                                <option value="0" selected>Bronze</option>
                                <option value="1">Silver</option>
                                <option value="2">Gold</option>
                                <option value="3">Platinum</option>
                                <option value="4">Diamond</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select class="form-select" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Sponsorship Details</label>
                            <textarea class="form-control" rows="3" name="details"
                                placeholder="Describe sponsorship tier and benefits..."></textarea>
                        </div>
                        <div class="modal-footer d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Save Sponsor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($sponsors as $data)
        <div class="modal fade" id="editSponsorModal{{ $data->sponsor_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold text-wrap me-3">Edit Sponsor Information</h5>
                        <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('admin.sponsor.update', $data->sponsor_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="modal_id" value="editSponsorModal{{ $data->sponsor_id }}">
                            
                            @if ($errors->any() && old('modal_id') == 'editSponsorModal' . $data->sponsor_id)
                                <div class="alert alert-danger small shadow-sm">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Sponsor Name</label>
                                <input type="text" class="form-control" value="{{ old('name', $data->name) }}" name="name"
                                    required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Current Logo</label>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="border p-1 rounded bg-light me-3" style="width: 60px; height: 60px;">
                                        <img src="{{ !empty($data->logo) ? asset($data->logo) : 'https://via.placeholder.com/60' }}"
                                            class="img-fluid w-100 h-100 object-fit-contain" alt="Current Logo">
                                    </div>
                                    <div class="small text-muted">Uploading a new logo will replace this one.</div>
                                </div>

                                <label class="form-label text-muted small fw-bold">Upload New Logo</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Website Link</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-link text-muted"></i></span>
                                    <input type="url" class="form-control" name="link"
                                        value="{{ old('link', $data->link) }}" placeholder="https://example.com">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Category</label>
                                <select class="form-select" name="sponsor_category">
                                    <option value="0" {{ $data->sponsor_category == 0 ? 'selected' : '' }}>Bronze
                                    </option>
                                    <option value="1" {{ $data->sponsor_category == 1 ? 'selected' : '' }}>Silver
                                    </option>
                                    <option value="2" {{ $data->sponsor_category == 2 ? 'selected' : '' }}>Gold
                                    </option>
                                    <option value="3" {{ $data->sponsor_category == 3 ? 'selected' : '' }}>Platinum
                                    </option>
                                    <option value="4" {{ $data->sponsor_category == 4 ? 'selected' : '' }}>Diamond
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Sponsorship Details</label>
                                <textarea class="form-control" rows="3" name="details">{{ $data->details }}</textarea>
                            </div>

                            <div class="modal-footer d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Update Sponsor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // Any custom sponsor logic can go here
    </script>
@endsection

