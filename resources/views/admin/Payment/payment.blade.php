@extends('admin.layout.admin')
@section('content')
    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Payment Verification</h5>
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

            @php
                $hasFilter = request()->filled('search') || request()->filled('status') || request()->filled('platform');
            @endphp
            <form action="{{ url('admin/dashboard/payment') }}" method="GET" id="paymentFilterForm">

                <div class="row mb-3 g-2">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" id="paymentSearchInput" class="form-control border-start-0"
                                placeholder="Search Transaction ID or Team Name..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="status" id="paymentStatusSelect">
                            <option value="">Status</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Approved</option>
                            <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-select" name="platform" id="paymentPlatformSelect">
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
                        <button type="button" id="paymentResetBtn"
                            class="btn btn-light border w-100 d-flex align-items-center justify-content-center payment-reset-btn {{ !$hasFilter ? 'is-disabled' : '' }}"
                            title="{{ $hasFilter ? 'Clear All Filters' : 'No filters applied' }}"
                            {{ !$hasFilter ? 'disabled' : '' }}>
                            <i class="fas fa-sync-alt text-muted"></i>
                        </button>
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
                            @forelse ($payment as $data)
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
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <i class="fas fa-wallet mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="fw-bold mb-1">No payments found</h5>
                                        <p class="mb-0 small">There are no payment records matching your search or filter.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    {{ $payment->appends(request()->query())->links('pagination::bootstrap-5') }}
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

    <style>
        .payment-reset-btn {
            transition: all 0.2s ease;
        }
        .payment-reset-btn:disabled,
        .payment-reset-btn.is-disabled {
            opacity: 0.55;
            cursor: not-allowed !important;
            pointer-events: auto !important;
        }
        .payment-reset-btn:not(:disabled):hover {
            background-color: #f1f5f9;
        }
        .payment-reset-btn:not(:disabled):hover i {
            color: #ef4444 !important;
            transform: rotate(-180deg);
            transition: transform 0.3s ease, color 0.2s ease;
        }
        body[data-theme="dark"] .payment-reset-btn {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
        body[data-theme="dark"] .payment-reset-btn i {
            color: #94a3b8 !important;
        }
        body[data-theme="dark"] .payment-reset-btn:not(:disabled):hover {
            background-color: #334155 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
        body[data-theme="dark"] .payment-reset-btn:not(:disabled):hover i {
            color: #f87171 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterForm = document.getElementById('paymentFilterForm');
            const searchInput = document.getElementById('paymentSearchInput');
            const statusSelect = document.getElementById('paymentStatusSelect');
            const platformSelect = document.getElementById('paymentPlatformSelect');
            const resetBtn = document.getElementById('paymentResetBtn');

            if (!filterForm || !searchInput || !statusSelect || !platformSelect || !resetBtn) return;

            const hasActiveUrlFilter = {{ $hasFilter ? 'true' : 'false' }};
            const cleanUrl = "{{ url('admin/dashboard/payment') }}";

            function updateResetButtonState() {
                const hasClientValues = (searchInput.value.trim() !== '') || 
                                        (statusSelect.value !== '') || 
                                        (platformSelect.value !== '');

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
            statusSelect.addEventListener('change', updateResetButtonState);
            platformSelect.addEventListener('change', updateResetButtonState);

            resetBtn.addEventListener('click', function (e) {
                e.preventDefault();

                if (resetBtn.hasAttribute('disabled')) {
                    return;
                }

                if (hasActiveUrlFilter) {
                    window.location.href = cleanUrl;
                } else {
                    searchInput.value = '';
                    statusSelect.value = '';
                    platformSelect.value = '';
                    updateResetButtonState();
                }
            });

            filterForm.addEventListener('submit', function (e) {
                const hasValues = (searchInput.value.trim() !== '') || 
                                  (statusSelect.value !== '') || 
                                  (platformSelect.value !== '');

                if (!hasValues) {
                    e.preventDefault();
                    if (hasActiveUrlFilter) {
                        window.location.href = cleanUrl;
                    }
                    return false;
                }
            });

            updateResetButtonState();
        });
    </script>
@endsection

