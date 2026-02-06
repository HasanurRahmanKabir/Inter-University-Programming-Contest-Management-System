@extends('admin.layout.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/notices_adminpanel.css">
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Notice Board</h5>

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
                    <h4 class="fw-bold mb-0 text-dark">All Announcements</h4>
                    <p class="text-muted small mb-0">Broadcast updates to participants, coaches, and volunteers.</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNoticeModal">
                    <i class="fas fa-plus-circle me-2"></i> Create Notice
                </button>
            </div>

            <form method="GET" action="{{ url('admin/dashboard/notice') }}" class="row mb-3 g-2">
                <div class="col-md-3">
                    <select name="audience" class="form-select">
                        <option value=""
                            {{ request('audience') === null || request('audience') === '' ? 'selected' : '' }}>Filter by
                            Audience</option>
                        <option value="All" {{ request('audience') === 'All' ? 'selected' : '' }}>All</option>
                        <option value="Participants" {{ request('audience') === 'Participants' ? 'selected' : '' }}>
                            Participants</option>
                        <option value="Coaches" {{ request('audience') === 'Coaches' ? 'selected' : '' }}>Coaches
                        </option>
                        <option value="Volunteers" {{ request('audience') === 'Volunteers' ? 'selected' : '' }}>
                            Volunteers</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value=""
                            {{ request('status') === null || request('status') === '' ? 'selected' : '' }}>Filter by Status
                        </option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
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
                                <th>Date</th>
                                <th style="width: 40%;">Title & Description</th>
                                <th>Audience</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notice as $data)
                                <tr>

                                    <td>

                                        <div class="fw-bold">{{ $data->notice_date }}</div>
                                        <small class="text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $data->title }}</div>
                                        <small class="text-muted d-block text-truncate" style="max-width: 350px;">
                                            {{ $data->description }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge badge-participants rounded-pill px-3 text-dark"
                                            style="background-color:#3b82f6">{{ $data->audience }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-opacity-10 "
                                            style="color:#198754; background-color: #f9f9f9">{{ $data->status ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-light btn-sm text-primary edit-notice-btn"
                                            data-bs-toggle="modal" data-bs-target="#editNoticeModal"
                                            data-notice='{{ base64_encode(json_encode(['id' => $data->notice_id, 'title' => $data->title, 'description' => $data->description, 'audience' => $data->audience, 'notice_date' => $data->notice_date, 'status' => $data->status])) }}'
                                            title="Edit"><i class="fas fa-edit"></i></button>
                                        <form action="{{ url('/admin/dashboard/notice/delete/' . $data->notice_id) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-light btn-sm text-danger"
                                                onclick="return confirm('Are you sure you want to delete this notice?')"
                                                title="Remove"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <nav class="mt-4">
                <ul class="pagination justify-content-end">
                    <li>{!! $notice->links('pagination::bootstrap-5') !!}</li>
                </ul>
            </nav>

        </div>
    </div>

    <div class="modal fade" id="createNoticeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Post New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/dashboard/notice/store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Notice Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title"
                                required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Target Audience</label>
                                <select class="form-select" name="audience">
                                    <option value="All">All Users</option>
                                    <option value="Participants">Participants Only</option>
                                    <option value="Coaches">Coaches Only</option>
                                    <option value="Volunteers">Volunteers Only</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-bold">Notice Publish Date</label>
                                <input type="date" class="form-control" name="notice_date">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Description</label>
                            <textarea class="form-control" name="description" rows="5"
                                placeholder="Write the full notice content here..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary px-4">Post Notice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editNoticeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Notice Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editNoticeForm" action="" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="editNoticeTitle" class="form-label text-muted small fw-bold">Edit Notice
                                Title</label>
                            <input type="text" id="editNoticeTitle" name="title" class="form-control"
                                placeholder="Enter title" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editNoticeAudience" class="form-label text-muted small fw-bold">Target
                                    Audience</label>
                                <select id="editNoticeAudience" name="audience" class="form-select">
                                    <option value="All">All Users</option>
                                    <option value="Participants">Participants Only</option>
                                    <option value="Coaches">Coaches Only</option>
                                    <option value="Volunteers">Volunteers Only</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label for="editNoticeDate" class="form-label text-muted small fw-bold">Edit
                                    Publish
                                    Date</label>
                                <input type="date" id="editNoticeDate" name="notice_date" class="form-control"
                                    name="notice_date">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="editNoticeDescription" class="form-label text-muted small fw-bold">Edit
                                Description</label>
                            <textarea id="editNoticeDescription" name="description" class="form-control" rows="5"
                                placeholder="Write the full notice content here..."></textarea>

                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select id="editNoticeStatus" name="status" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-primary px-4">Update Notice</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Clean Query Params after load
            try {
                if (window.location.search) {
                    history.replaceState(null, '', window.location.pathname + window.location.hash);
                }
            } catch (e) {}


            // EDIT MODAL LOGIC (FIXED)
            var editModal = document.getElementById('editNoticeModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function(event) {

                    var button = event.relatedTarget;

                    var rawData = button.getAttribute('data-notice');

                    if (rawData) {
                        try {

                            var data = JSON.parse(atob(rawData));


                            var modalTitle = editModal.querySelector('#editNoticeTitle');
                            var modalDesc = editModal.querySelector('#editNoticeDescription');
                            var modalAudience = editModal.querySelector('#editNoticeAudience');
                            var modalDate = editModal.querySelector('#editNoticeDate');
                            var modalStatus = editModal.querySelector('#editNoticeStatus');
                            var modalForm = editModal.querySelector('#editNoticeForm');


                            modalTitle.value = data.title;
                            modalDesc.value = data.description;
                            modalAudience.value = data.audience;
                            modalDate.value = data.notice_date;
                            modalStatus.value = data.status;

                            modalForm.action = "{{ url('/admin/dashboard/notice/update') }}/" + data.id;

                        } catch (error) {
                            console.error("Error parsing notice data:", error);
                        }
                    }
                });
            }
        });
    </script>
@endsection
