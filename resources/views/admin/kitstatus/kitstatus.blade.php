@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Kit Distribution</h5>

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

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 border-start border-primary border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted small text-uppercase fw-bold">Total Registered Team</h6>
                                <h3 class="fw-bold text-primary">{{ $totalTeams }}</h3>
                            </div>
                            <i class="fas fa-users fa-2x text-gray-300 opacity-25"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 border-start border-success border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted small text-uppercase fw-bold">Kits Distributed</h6>
                                <h3 class="fw-bold text-success">{{ $kitsDistributed }}</h3>
                            </div>
                            <i class="fas fa-gift fa-2x text-gray-300 opacity-25"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 border-start border-warning border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted small text-uppercase fw-bold">Pending Distribution</h6>
                                <h3 class="fw-bold text-warning">{{ $pendingDistribution }}</h3>
                            </div>
                            <i class="fas fa-hourglass-half fa-2x text-gray-300 opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ url('admin/dashboard/kitstatus') }}">
                <div class="row mb-3 g-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="q" value="{{ request('q') }}"
                                class="form-control border-start-0" placeholder="Search by Team Name...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="filter" class="form-select">
                            <option value=""
                                {{ request('filter') === null || request('filter') === '' ? 'selected' : '' }}>Status: All
                            </option>
                            <option value="1" {{ request('filter') === '1' ? 'selected' : '' }}>Received</option>
                            <option value="0" {{ request('filter') === '0' ? 'selected' : '' }}>Not Received</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-stretch">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="fas fa-search me-2"></i>
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Team Name</th>
                                <th>Kit Received?</th>
                                <th>Received Date</th>
                                <th>Comments</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kits as $kit)
                                <tr class="{{ $kit->kit_received ? '' : 'table-warning bg-opacity-10' }}">
                                    <td>
                                        <div class="fw-bold">{{ $kit->team_name ?? 'N/A' }}</div>
                                        <small class="text-muted">ID: #{{ $kit->team_id }}</small>
                                    </td>
                                    <td>
                                        @if ($kit->kit_received)
                                            <span class="badge bg-success rounded-pill px-3">
                                                <i class="fas fa-check me-1"></i> Yes
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark rounded-pill px-3">
                                                <i class="fas fa-times me-1"></i> No
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($kit->received_date)
                                            <div class="small text-dark">
                                                {{ \Carbon\Carbon::parse($kit->received_date)->format('d M Y') }}</div>
                                            <div class="small text-muted">
                                                {{ \Carbon\Carbon::parse($kit->received_date)->format('h:i A') }}</div>
                                        @else
                                            <span class="text-muted small">--</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $kit->comments ?? '--' }}</span>
                                    </td>
                                    <td class="text-end">
                                        {{-- EDIT BUTTON WITH DATA ATTRIBUTES --}}
                                        <button class="btn btn-light btn-sm text-primary edit-kit-btn"
                                            data-bs-toggle="modal" data-bs-target="#editKitStatusModal"
                                            data-id="{{ $kit->kit_id }}" data-team="{{ $kit->team_name }}"
                                            data-status="{{ $kit->kit_received }}"
                                            data-date="{{ $kit->received_date ? \Carbon\Carbon::parse($kit->received_date)->format('Y-m-d\TH:i') : '' }}"
                                            data-comments="{{ $kit->comments }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No kit status records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {!! $kits->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editKitStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Kit Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{-- Form Action Will be set by JS --}}
                    <form id="editKitForm" action="" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Edit Team Name</label>
                            <input type="text" id="editTeamName" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Edit Status</label>
                            <select name="kit_received" id="editKitStatus" class="form-select fw-bold">
                                <option value="1">Received</option>
                                <option value="0">Not Received</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Edit Received Date & Time</label>
                            <input type="datetime-local" name="received_date" id="editReceivedDateTime"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Edit Comments (Optional)</label>
                            <textarea name="comments" id="editKitComments" class="form-control" rows="2"
                                placeholder="Ex: Collected by Volunteer X..."></textarea>
                        </div>

                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Update Kit Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        (function() {
            // Sidebar Logic
            const sb = document.getElementById('sidebar');
            const ov = document.getElementById('overlay');
            const tgl = document.getElementById('sidebarToggle');

            function toggleSidebar() {
                if (!sb || !ov) return;
                sb.classList.toggle('active');
                ov.classList.toggle('active');
            }
            if (tgl) tgl.addEventListener('click', toggleSidebar);
            if (ov) ov.addEventListener('click', toggleSidebar);

            // Refresh handler logic (as per your code)
            const storageKey = 'kitstatus_refreshed';
            window.addEventListener('pageshow', function(event) {
                try {
                    const url = new URL(window.location.href);
                    const hasQ = (url.searchParams.get('q') || '') !== '';
                    const hasFilter = (url.searchParams.get('filter') || '') !== '';
                    if (!hasQ && !hasFilter) return;
                    const navEntries = performance.getEntriesByType && performance.getEntriesByType(
                        'navigation');
                    const navType = (navEntries && navEntries[0] && navEntries[0].type) || (performance &&
                        performance.navigation && performance.navigation.type === 1 ? 'reload' : null);
                    const isReload = navType === 'reload' || (performance && performance.navigation &&
                        performance.navigation.type === 1) || event.persisted;
                    if (isReload && !sessionStorage.getItem(storageKey)) {
                        sessionStorage.setItem(storageKey, '1');
                        window.location.replace(window.location.pathname);
                    } else {
                        sessionStorage.removeItem(storageKey);
                    }
                } catch (e) {
                    console.debug('kitstatus refresh handler error', e);
                }
            });

            // EDIT MODAL LOGIC
            const editBtns = document.querySelectorAll('.edit-kit-btn');
            const editForm = document.getElementById('editKitForm');
            const editTeamName = document.getElementById('editTeamName');
            const editKitStatus = document.getElementById('editKitStatus');
            const editReceivedDateTime = document.getElementById('editReceivedDateTime');
            const editKitComments = document.getElementById('editKitComments');

            editBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Get data from button attributes
                    const id = this.getAttribute('data-id');
                    const team = this.getAttribute('data-team');
                    const status = this.getAttribute('data-status');
                    const date = this.getAttribute('data-date');
                    const comments = this.getAttribute('data-comments');

                    // Populate Modal Fields
                    editTeamName.value = team;
                    editKitStatus.value = status;
                    editReceivedDateTime.value = date;
                    editKitComments.value = comments;

                    // Set Form Action URL dynamically
                    editForm.action = "{{ url('/admin/dashboard/kitstatus/update') }}/" + id;
                });
            });

        })();
    </script>
@endsection
