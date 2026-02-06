@extends('admin.layout.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/download_details.css">

    <div class="main-content">
        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Download Details</h5>

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
            </div>
        </nav>

        <div class="container-fluid p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Team Details</h4>
                    <p class="text-muted small mb-0">View and export details: institution, team, coach, members,
                        verification.</p>
                </div>
                <button class="btn btn-success" id="exportAllBtn"><i class="fas fa-file-excel me-2"></i>Export All to
                    Excel</button>
            </div>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="detailsTable">
                        <thead>
                            <tr>
                                <th>Institution</th>
                                <th>Team Name</th>
                                <th>Coach Name</th>
                                <th>Coach T-Shirt</th>
                                <th>Coach Contact</th>
                                <th>Coach Email</th>
                                <th>Team Members (with T-Shirt Sizes)</th>
                                <th>Payment</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="detailsTbody">
                            @foreach ($details as $data)
                                <tr>
                                    <td>{{ $data->institute_name }}</td>
                                    <td>{{ $data->team_name }}</td>
                                    <td>{{ $data->coach_name }}</td>
                                    <td>
                                        <span class="badge bg-dark text-white">{{ $data->coach_t_shirt }}</span>
                                    </td>
                                    <td>{{ $data->coach_phone }}</td>
                                    <td>{{ $data->coach_email }}</td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            @if ($data->mem_1_name)
                                                <li>
                                                    {{ $data->mem_1_name }} -
                                                    <span class="badge bg-info text-dark">{{ $data->mem_1_t_shirt }}</span>
                                                </li>
                                            @endif
                                            @if ($data->mem_2_name)
                                                <li>
                                                    {{ $data->mem_2_name }} -
                                                    <span class="badge bg-info text-dark">{{ $data->mem_2_t_shirt }}</span>
                                                </li>
                                            @endif
                                            @if ($data->mem_3_name)
                                                <li>
                                                    {{ $data->mem_3_name }} -
                                                    <span class="badge bg-info text-dark">{{ $data->mem_3_t_shirt }}</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>
                                        <span class="badge {{ $data->is_paid ? 'bg-success' : 'bg-danger' }}">
                                            {{ $data->is_paid ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <!-- View Button -->
                                        <button class="btn btn-light btn-sm text-primary" title="View Details"
                                            data-bs-toggle="modal" data-bs-target="#viewDetailsModal{{ $data->team_id }}">
                                            <i class="fas fa-eye me-1"></i> View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <!-- Modals -->
                        @foreach ($details as $data)
                            <div class="modal fade" id="viewDetailsModal{{ $data->team_id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Team Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Institution</div>
                                                        <div>{{ $data->institute_name }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Team Name</div>
                                                        <div>{{ $data->team_name }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Coach Name</div>
                                                        <div>{{ $data->coach_name }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Coach T-Shirt</div>
                                                        <div>
                                                            <span
                                                                class="badge bg-dark text-white">{{ $data->coach_t_shirt }}</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Coach Contact</div>
                                                        <div>{{ $data->coach_phone }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Coach Email</div>
                                                        <div>{{ $data->coach_email }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Payment Status</div>
                                                        <div>
                                                            <span
                                                                class="badge {{ $data->is_paid ? 'bg-success' : 'bg-danger' }}">
                                                                {{ $data->is_paid ? 'Paid' : 'Unpaid' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="p-3 border rounded">
                                                        <div class="fw-bold mb-2">Team Members</div>
                                                        <ul class="mb-0 ps-3">
                                                            @if ($data->mem_1_name)
                                                                <li>
                                                                    <strong>{{ $data->mem_1_name }}</strong> -
                                                                    {{ $data->mem_1_email }} |
                                                                    T-Shirt: <span
                                                                        class="badge bg-info text-dark">{{ $data->mem_1_t_shirt }}</span>
                                                                </li>
                                                            @endif
                                                            @if ($data->mem_2_name)
                                                                <li>
                                                                    <strong>{{ $data->mem_2_name }}</strong> -
                                                                    {{ $data->mem_2_email }} |
                                                                    T-Shirt: <span
                                                                        class="badge bg-info text-dark">{{ $data->mem_2_t_shirt }}</span>
                                                                </li>
                                                            @endif
                                                            @if ($data->mem_3_name)
                                                                <li>
                                                                    <strong>{{ $data->mem_3_name }}</strong> -
                                                                    {{ $data->mem_3_email }} |
                                                                    T-Shirt: <span
                                                                        class="badge bg-info text-dark">{{ $data->mem_3_t_shirt }}</span>
                                                                </li>
                                                            @endif
                                                        </ul>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sm" style="background-color: #6c757d; color: #ffffff;"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            const teamDetails = @json($details);
                        </script>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

                        <script>
                            function exportAllToExcel() {

                                let excelData = teamDetails.map(team => {
                                    return {
                                        "Institution": team.institute_name,
                                        "Team Name": team.team_name,
                                        "Coach Name": team.coach_name,
                                        "Coach T-Shirt Size": team.coach_t_shirt,
                                        "Coach Contact": team.coach_phone,
                                        "Coach Email": team.coach_email,

                                        "Member 1 Name": team.mem_1_name ?? '',
                                        "Member 1 Email": team.mem_1_email ?? '',
                                        "Member 1 T-Shirt": team.mem_1_t_shirt ?? '',

                                        "Member 2 Name": team.mem_2_name ?? '',
                                        "Member 2 Email": team.mem_2_email ?? '',
                                        "Member 2 T-Shirt": team.mem_2_t_shirt ?? '',

                                        "Member 3 Name": team.mem_3_name ?? '',
                                        "Member 3 Email": team.mem_3_email ?? '',
                                        "Member 3 T-Shirt": team.mem_3_t_shirt ?? '',

                                        "Payment Status": team.is_paid ? "Paid" : "Unpaid"
                                    };
                                });

                                const workbook = XLSX.utils.book_new();
                                const worksheet = XLSX.utils.json_to_sheet(excelData);

                                XLSX.utils.book_append_sheet(workbook, worksheet, "Team Details");

                                XLSX.writeFile(workbook, "team-details.xlsx");
                            }

                            document.getElementById('exportAllBtn')
                                .addEventListener('click', exportAllToExcel);
                        </script>


                        </body>

                        </html>
