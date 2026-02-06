<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coach Dashboard - SUBIUPC</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/coachdashboard.css">
</head>

<body>
    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-tachometer-alt me-2"></i>Coach Dashboard</h1>
                    <p class="subtitle mb-0">
                        {{ $contest->title ?? 'SUBIUPC 2026 - Inter University Programming Contest' }}
                    </p>
                </div>
                <div>
                    <button class="btn btn-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-1"></i>Edit Profile
                    </button>
                    <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="row mb-4 justify-content-center">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-users fa-2x text-primary"></i>
                    <h3>3</h3>
                    <p>Team Members</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-left-color: #10b981">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
                    <h3>{{ $user->is_paid ? 'Paid' : 'Unpaid' }}</h3>
                    <p>Payment Status</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-left-color: #f59e0b">
                    <i class="fas fa-calendar fa-2x text-warning"></i>
                    <h3>{{ $user->created_at->format('d M, Y') }}</h3>
                    <p>Registration Date</p>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-university"></i>
                <h5>Team & Institution Information</h5>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-label">Team Name</div>
                    <div class="info-value">{{ $user->team_name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Institution Name</div>
                    <div class="info-value">{{ $user->institute_name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Team ID</div>
                    <div class="info-value">#{{ $user->team_id }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Selection Status</div>
                    <div class="info-value">
                        @if ($user->is_selected)
                            <span class="badge bg-success">Selected</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-chalkboard-teacher"></i>
                <h5>Coach Information</h5>
            </div>
            <div class="row">
                <div class="col-md-3 text-center">
                    @if ($user->coach_photo)
                        <img src="{{ asset($user->coach_photo) }}" alt="Coach Photo" class="profile-image" />
                    @else
                        <img src="https://via.placeholder.com/150" alt="Coach Photo" class="profile-image" />
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Coach Name</div>
                            <div class="info-value">{{ $user->coach_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Coach Email</div>
                            <div class="info-value">{{ $user->coach_email }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Coach Phone</div>
                            <div class="info-value">{{ $user->coach_phone }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">T-Shirt Size</div>
                            <div class="info-value">{{ $user->coach_t_shirt }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-users"></i>
                <h5>Team Members</h5>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="member-card">
                        <img src="{{ $user->mem_1_photo ? asset($user->mem_1_photo) : 'https://via.placeholder.com/100' }}"
                            class="member-image" />
                        <h6>{{ $user->mem_1_name }}</h6>
                        <div class="text-start mt-3">
                            <div class="info-label">Student ID</div>
                            <div class="info-value">{{ $user->mem_1_student_id }}</div>

                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $user->mem_1_email }}</div>

                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $user->mem_1_phone }}</div>

                            <div class="info-label">T-Shirt</div>
                            <div class="info-value">{{ $user->mem_1_t_shirt }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="member-card">
                        <img src="{{ $user->mem_2_photo ? asset($user->mem_2_photo) : 'https://via.placeholder.com/100' }}"
                            class="member-image" />
                        <h6>{{ $user->mem_2_name }}</h6>
                        <div class="text-start mt-3">
                            <div class="info-label">Student ID</div>
                            <div class="info-value">{{ $user->mem_2_student_id }}</div>

                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $user->mem_2_email }}</div>

                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $user->mem_2_phone }}</div>

                            <div class="info-label">T-Shirt</div>
                            <div class="info-value">{{ $user->mem_2_t_shirt }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="member-card">
                        <img src="{{ $user->mem_3_photo ? asset($user->mem_3_photo) : 'https://via.placeholder.com/100' }}"
                            class="member-image" />
                        <h6>{{ $user->mem_3_name }}</h6>
                        <div class="text-start mt-3">
                            <div class="info-label">Student ID</div>
                            <div class="info-value">{{ $user->mem_3_student_id }}</div>

                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $user->mem_3_email }}</div>

                            <div class="info-label">Phone</div>
                            <div class="info-value">{{ $user->mem_3_phone }}</div>

                            <div class="info-label">T-Shirt</div>
                            <div class="info-value">{{ $user->mem_3_t_shirt }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->is_selected == 1)

            @if ($payment && $payment->transaction_id)

                <div class="transaction-section mt-4">
                    <div class="alert alert-info border-0 shadow-sm">
                        <h5 class="alert-heading fw-bold"><i class="fas fa-check-circle me-2"></i>Payment Submitted!
                        </h5>
                        <p>You have successfully submitted your payment details. Please wait for admin verification.</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Transaction ID:</strong> <br>
                                <span class="badge bg-light text-dark border">{{ $payment->transaction_id }}</span>
                            </div>
                            <div class="col-md-4">
                                <strong>Method:</strong> <br> {{ $payment->platform ?? 'N/A' }}
                            </div>
                            <div class="col-md-4">
                                <strong>Status:</strong> <br>
                                @if ($payment->payment_status == 1)
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending Review</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="transaction-section mt-4">
                    <h5><i class="fas fa-receipt me-2"></i>Payment Verification</h5>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <p class="mb-3">
                        Please enter your transaction ID to verify your registration.
                    </p>

                    <form action="{{ route('coach.payment.store') }}" method="POST">
                        @csrf

                        <div class="row align-items-end">

                            <div class="col-md-4 mb-3">
                                <label class="mb-2 fw-semibold">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="bKash">bKash</option>
                                    <option value="Nagad">Nagad</option>
                                    <option value="Rocket">Rocket</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="mb-2 fw-semibold">Transaction ID <span
                                        class="text-warning">*</span></label>
                                <input type="text" name="transaction_id" class="form-control"
                                    placeholder="e.g., TRX123456789" required />
                            </div>

                            <div class="col-md-4 mb-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Payment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @else
            <div class="alert alert-warning mt-4">
                <i class="fas fa-hourglass-half me-2"></i>
                <strong>Pending Selection:</strong> Once your team is selected by the admin, the payment option will
                appear here.
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Team Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('coach.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active fw-bold" id="coach-tab" data-bs-toggle="tab"
                                    data-bs-target="#coach" type="button" role="tab">Coach Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold" id="mem1-tab" data-bs-toggle="tab"
                                    data-bs-target="#mem1" type="button" role="tab">Member 1</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold" id="mem2-tab" data-bs-toggle="tab"
                                    data-bs-target="#mem2" type="button" role="tab">Member 2</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fw-bold" id="mem3-tab" data-bs-toggle="tab"
                                    data-bs-target="#mem3" type="button" role="tab">Member 3</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="profileTabsContent">

                            <div class="tab-pane fade show active" id="coach" role="tabpanel">
                                <h6 class="text-primary mb-3">Coach Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Coach Name</label>
                                        <input type="text" class="form-control" name="coach_name"
                                            value="{{ $user->coach_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control" name="coach_phone"
                                            value="{{ $user->coach_phone }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">T-Shirt Size</label>
                                        <select class="form-select" name="coach_t_shirt">
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                <option value="{{ $size }}"
                                                    {{ $user->coach_t_shirt == $size ? 'selected' : '' }}>
                                                    {{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Photo</label>
                                        <input type="file" class="form-control" name="coach_photo"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mem1" role="tabpanel">
                                <h6 class="text-primary mb-3">Member 1 Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name</label>
                                        <input type="text" class="form-control" name="mem_1_name"
                                            value="{{ $user->mem_1_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email</label>
                                        <input type="email" class="form-control" name="mem_1_email"
                                            value="{{ $user->mem_1_email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control" name="mem_1_phone"
                                            value="{{ $user->mem_1_phone }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">T-Shirt Size</label>
                                        <select class="form-select" name="mem_1_t_shirt">
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                <option value="{{ $size }}"
                                                    {{ $user->mem_1_t_shirt == $size ? 'selected' : '' }}>
                                                    {{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Photo</label>
                                        <input type="file" class="form-control" name="mem_1_photo"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mem2" role="tabpanel">
                                <h6 class="text-primary mb-3">Member 2 Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name</label>
                                        <input type="text" class="form-control" name="mem_2_name"
                                            value="{{ $user->mem_2_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email</label>
                                        <input type="email" class="form-control" name="mem_2_email"
                                            value="{{ $user->mem_2_email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control" name="mem_2_phone"
                                            value="{{ $user->mem_2_phone }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">T-Shirt Size</label>
                                        <select class="form-select" name="mem_2_t_shirt">
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                <option value="{{ $size }}"
                                                    {{ $user->mem_2_t_shirt == $size ? 'selected' : '' }}>
                                                    {{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Photo</label>
                                        <input type="file" class="form-control" name="mem_2_photo"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mem3" role="tabpanel">
                                <h6 class="text-primary mb-3">Member 3 Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name</label>
                                        <input type="text" class="form-control" name="mem_3_name"
                                            value="{{ $user->mem_3_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email</label>
                                        <input type="email" class="form-control" name="mem_3_email"
                                            value="{{ $user->mem_3_email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control" name="mem_3_phone"
                                            value="{{ $user->mem_3_phone }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">T-Shirt Size</label>
                                        <select class="form-select" name="mem_3_t_shirt">
                                            @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                                <option value="{{ $size }}"
                                                    {{ $user->mem_3_t_shirt == $size ? 'selected' : '' }}>
                                                    {{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Photo</label>
                                        <input type="file" class="form-control" name="mem_3_photo"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
