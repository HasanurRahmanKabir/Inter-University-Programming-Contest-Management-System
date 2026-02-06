@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 text-secondary">Payment Verification</h5>
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

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 border-start border-success border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted small text-uppercase fw-bold">Total Collected</h6>
                                <h3 class="fw-bold text-success">৳ {{ number_format($totalCollected) }}</h3>
                            </div>
                            <i class="fas fa-wallet fa-2x text-gray-300 opacity-25"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 border-start border-warning border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted small text-uppercase fw-bold">Pending Verification</h6>
                                <h3 class="fw-bold text-warning">{{ $pendingVerification }}</h3>
                            </div>
                            <i class="fas fa-clock fa-2x text-gray-300 opacity-25"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3 border-start border-danger border-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="text-muted small text-uppercase fw-bold">Today's Collection</h6>
                                <h3 class="fw-bold text-dark">৳ {{ number_format($todaysCollection) }}</h3>
                            </div>
                            <i class="fas fa-calendar-day fa-2x text-gray-300 opacity-25"></i>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ url('admin/dashboard/payment') }}" method="GET">

                <div class="row mb-3 g-2">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Search Transaction ID or Team Name..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="status">
                            <option value="">Status</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Approved</option>
                            <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="platform">
                            <option value="">Platform</option>
                            <option value="bKash" {{ request('platform') == 'bKash' ? 'selected' : '' }}>bKash</option>
                            <option value="Nagad" {{ request('platform') == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                            <option value="Rocket" {{ request('platform') == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                            <option value="Bank" {{ request('platform') == 'Bank' ? 'selected' : '' }}>Bank</option>
                        </select>
                    </div>

                    <div class="col-md-1 d-flex align-items-stretch">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center" title="Search">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <div class="col-md-1 d-flex align-items-stretch">

                        <a href="{{ url('admin/dashboard/payment') }}"
                            class="btn btn-light border w-100 d-flex align-items-center justify-content-center"
                            title="Refresh/Reset">
                            <i class="fas fa-sync-alt text-muted"></i>
                        </a>
                    </div>
                </div>
            </form>

            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Pay ID</th>
                                <th>Team Name</th>
                                <th>Trx ID</th>
                                <th>Platform</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($payment as $data)
                                <tr class="table-warning bg-opacity-10 align-middle">
                                    <td>{{ $data->payment_id }}</td>
                                    <td class="fw-bold">{{ $data->team_name }}</td>
                                    <td class="font-monospace">{{ $data->transaction_id }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $data->platform == 'bKash' ? 'bg-danger' : ($data->platform == 'Nagad' ? 'bg-warning text-dark' : 'bg-primary') }} rounded-pill px-3">
                                            {{ $data->platform }}
                                        </span>
                                    </td>
                                    <td class="fw-bold">{{ $data->amount }}</td>
                                    <td class="small text-muted">{{ $data->created_at }}</td>
                                    <td>
                                        @if ($data->payment_status == 1)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($data->payment_status == 2)
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#verifyModal{{ $data->payment_id }}">
                                            <i class="fas fa-check-circle me-1"></i> Verify
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @foreach ($payment as $data)
        <div class="modal fade" id="verifyModal{{ $data->payment_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Verify Payment #{{ $data->payment_id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.payment.update', $data->payment_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body text-start">
                            <div class="alert alert-info small mb-3">
                                <i class="fas fa-info-circle me-1"></i> Check Transaction ID before approving.
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Team Name</label>
                                <input type="text" class="form-control" value="{{ $data->team_name }}" readonly>
                            </div>

                            <div class="row g-2">
                                <div class="col-6 mb-3">
                                    <label class="form-label text-muted small fw-bold">Platform</label>
                                    <select class="form-select" name="platform">
                                        <option value="bKash" {{ $data->platform == 'bKash' ? 'selected' : '' }}>bKash
                                        </option>
                                        <option value="Nagad" {{ $data->platform == 'Nagad' ? 'selected' : '' }}>Nagad
                                        </option>
                                        <option value="Rocket" {{ $data->platform == 'Rocket' ? 'selected' : '' }}>Rocket
                                        </option>
                                        <option value="Bank" {{ $data->platform == 'Bank' ? 'selected' : '' }}>Bank
                                        </option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label text-muted small fw-bold">Amount</label>
                                    <input type="text" class="form-control" name="amount"
                                        value="{{ $data->amount }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Transaction ID</label>
                                <div class="input-group">
                                    <input type="text" class="form-control font-monospace fs-5" name="transaction_id"
                                        value="{{ $data->transaction_id }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Status</label>
                                <select class="form-select" name="payment_status">
                                    <option value="1" {{ $data->payment_status == 1 ? 'selected' : '' }}>Approve
                                    </option>
                                    <option value="0" {{ $data->payment_status == 0 ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="2" {{ $data->payment_status == 2 ? 'selected' : '' }}>Reject
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success fw-bold px-4">Save Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                if (overlay) overlay.classList.toggle('active');
            });
        }
    </script>
@endsection
