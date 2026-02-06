   @extends('admin.layout.admin')

   @section('content')
       <div class="main-content">
           <nav class="navbar navbar-expand-lg top-navbar">
               <div class="container-fluid">
                   <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                       <i class="fas fa-bars"></i>
                   </button>

                   <h5 class="mb-0 text-secondary d-none d-sm-block">
                       Welcome back, Super Admin!
                   </h5>

                   <div class="ms-auto d-flex align-items-center">
                       <div class="dropdown">
                           <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                               id="userDropdown" data-bs-toggle="dropdown">
                               <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="Admin"
                                   class="rounded-circle me-2" width="40" height="40" />
                               <span class="fw-medium d-none d-sm-inline">Admin User</span>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                               <li>
                                   <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                       data-bs-target="#profileModal">Profile</a>
                               </li>
                               <li>
                                   <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                       data-bs-target="#settingsModal">Settings</a>
                               </li>
                               <li>
                                   <hr class="dropdown-divider" />
                               </li>
                               <li>
                                   <a class="dropdown-item text-danger" href="admin_login.html">Logout</a>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
           </nav>

           <div class="container-fluid p-4">
               <div class="row g-4 mb-5">
                   <div class="col-md-6 col-lg-3">
                       <div class="stat-card">
                           <div class="stat-icon bg-icon-primary">
                               <i class="fas fa-users"></i>
                           </div>
                           <h6 class="text-muted mb-1">Total Registered Teams</h6>
                           <h3 class="fw-bold mb-0">{{ $totalTeams }}</h3>
                       </div>
                   </div>

                   <div class="col-md-6 col-lg-3">
                       <div class="stat-card">
                           <div class="stat-icon bg-icon-warning">
                               <i class="fas fa-file-invoice-dollar"></i>
                           </div>
                           <h6 class="text-muted mb-1">Pending Payments</h6>
                           <h3 class="fw-bold mb-0">{{ $pendingPayments }}</h3>
                       </div>
                   </div>

                   <div class="col-md-6 col-lg-3">
                       <div class="stat-card">
                           <div class="stat-icon bg-icon-success">
                               <i class="fas fa-code"></i>
                           </div>
                           <h6 class="text-muted mb-1">Active Contest</h6>
                           <h5 class="fw-bold mb-0 text-truncate">
                               {{ $activeContest->title ?? 'No Active Contest' }}
                           </h5>

                       </div>
                   </div>

                   <div class="col-md-6 col-lg-3">
                       <div class="stat-card">
                           <div class="stat-icon bg-icon-purple">
                               <i class="fas fa-box-open"></i>
                           </div>
                           <h6 class="text-muted mb-1">Kits Distributed</h6>
                           <h3 class="fw-bold mb-0">{{ $kitsDistributed }}</h3>
                       </div>
                   </div>
               </div>

               <div class="row">
                   <div class="col-12">
                       <div class="custom-table-card p-4">

                           <div class="d-flex justify-content-between align-items-center mb-4">
                               <h5 class="fw-bold mb-0">Recent Team Registrations</h5>
                               <a href="{{ route('admin.teamregistration.index') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                   View All
                               </a>
                           </div>

                           <div class="table-responsive">
                               <table class="table table-hover mb-0 align-middle">
                                   <thead>
                                       <tr>
                                           <th>ID</th>
                                           <th>Team Name</th>
                                           <th>Institute</th>
                                           <th>Coach Info</th>
                                           <th>Status (Pay | Sel)</th>
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
                                                       class="badge {{ $data->is_paid ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-white px-3 py-1 rounded-pill">
                                                       {{ $data->is_paid ? 'Paid' : 'Unpaid' }}
                                                   </span>
                                                   <span
                                                       class="badge {{ $data->is_selected ? 'bg-primary' : 'bg-secondary' }} bg-opacity-10 text-white px-3 py-1 rounded-pill">
                                                       {{ $data->is_selected ? 'Selected' : 'Not Selected' }}
                                                   </span>
                                               </td>
                                               <td class="text-end">
                                                   <!-- View Button -->
                                                   <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal"
                                                       data-bs-target="#teamDetailModal{{ $data->team_id }}">
                                                       <i class="fas fa-eye"></i> View
                                                   </button>
                                               </td>
                                           </tr>

                                           <!-- Modal -->
                                           <div class="modal fade" id="teamDetailModal{{ $data->team_id }}" tabindex="-1"
                                               aria-labelledby="teamDetailModalLabel{{ $data->team_id }}"
                                               aria-hidden="true">
                                               <div class="modal-dialog modal-dialog-centered modal-lg">
                                                   <div class="modal-content">
                                                       <div class="modal-header">
                                                           <h5 class="modal-title"
                                                               id="teamDetailModalLabel{{ $data->team_id }}">
                                                               Team Details - {{ $data->team_name }}
                                                           </h5>
                                                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                               aria-label="Close"></button>
                                                       </div>
                                                       <div class="modal-body">
                                                           <div class="row g-3">
                                                               <div class="col-md-6">
                                                                   <strong>Team ID:</strong> {{ $data->team_id }}
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <strong>Institute:</strong> {{ $data->institute_name }}
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <strong>Coach Name:</strong> {{ $data->coach_name }}
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <strong>Coach Phone:</strong> {{ $data->coach_phone }}
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <strong>Payment Status:</strong>
                                                                   {{ $data->is_paid ? 'Paid' : 'Unpaid' }}
                                                               </div>
                                                               <div class="col-md-6">
                                                                   <strong>Team Selection:</strong>
                                                                   {{ $data->is_selected ? 'Selected' : 'Not Selected' }}
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="button" class="btn btn-secondary"
                                                               data-bs-dismiss="modal">Close</button>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <!-- End Modal -->

                                       @empty
                                           <tr>
                                               <td colspan="6" class="text-center text-muted py-4">
                                                   No team registrations found
                                               </td>
                                           </tr>
                                       @endforelse
                                   </tbody>
                               </table>
                           </div>

                       </div>
                   </div>
               </div>
