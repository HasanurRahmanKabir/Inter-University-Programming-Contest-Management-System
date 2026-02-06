@extends('admin.layout.admin')
@section('content')
    <div class="main-content">


        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Sponsors & Partners</h5>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                            id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Admin"
                                class="rounded-circle me-2" width="40" height="40">
                            <span class="fw-medium d-none d-sm-inline">Admin User</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">


            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Sponsor List</h4>
                    <p class="text-muted small mb-0">Manage event sponsors and their branding.</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSponsorModal">
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
                                <th style="width: 25%;">Sponsor Info</th>
                                <th style="width: 35%;">Details</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sponsors as $data)
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
                                            <span class="badge bg-info text-dark border border-info bg-opacity-25">
                                                @if ($data->sponsor_category == 0)
                                                    Bronze
                                                @elseif($data->sponsor_category == 1)
                                                    Silver
                                                @elseif($data->sponsor_category == 2)
                                                    Gold
                                                @elseif($data->sponsor_category == 3)
                                                    Platinum
                                                @elseif($data->sponsor_category == 4)
                                                    Diamond
                                                @endif
                                            </span>
                                        </div>
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

                                        <form action="{{ url('/admin/dashboard/sponsor/delete/' . $data->sponsor_id) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="btn btn-light btn-sm text-danger shadow-sm border ms-1"
                                                onclick="return confirm('Are you sure you want to delete this sponsor?')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
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


    <div class="modal fade" id="addSponsorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Sponsor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin/dashboard/sponsor/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                            <label class="form-label text-muted small fw-bold">Sponsorship Details</label>
                            <textarea class="form-control" rows="3" name="details"
                                placeholder="Describe sponsorship tier and benefits..."></textarea>
                        </div>
                        <div class="modal-footer">
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
                        <h5 class="modal-title fw-bold">Edit Sponsor Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">


                        <form action="{{ route('admin.sponsor.update', $data->sponsor_id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Edit Sponsor Name</label>
                                <input type="text" class="form-control" value="{{ $data->name }}" name="name"
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
                                        value="{{ $data->link }}" placeholder="https://example.com">
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
                                <label class="form-label text-muted small fw-bold">Edit Sponsorship Details</label>
                                <textarea class="form-control" rows="3" name="details">{{ $data->details }}</textarea>
                            </div>

                            <div class="modal-footer">
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
        // Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }
    </script>
@endsection
