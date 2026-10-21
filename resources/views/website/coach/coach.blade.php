<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coach Dashboard - {{ $setting->website_name ?? 'Your Website Name' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->coach_favicon) ? asset($setting->coach_favicon) : (!empty($setting->website_favicon) ? asset($setting->website_favicon) : asset('content/website/image/favicon.ico')) }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/coachdashboard.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/dark-mode.css">
    <style>
        @keyframes subtleCoachInputShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
        .coach-phone-shake {
            animation: subtleCoachInputShake 0.3s ease-in-out;
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }
        body[data-theme="dark"] .coach-phone-alert {
            color: #f87171 !important;
        }
        
        /* Modal Photo Upload & Preview Styling - Modern Industry Standard */
        .photo-upload-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .photo-upload-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .modal-photo-preview-box {
            position: relative;
            width: 76px;
            height: 76px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .modal-photo-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.2s;
        }
        .modal-photo-preview-box .preview-overlay-tag {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff;
            font-size: 0.65rem;
            text-align: center;
            padding: 2px 0;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .image-specs-badge {
            font-size: 0.72rem;
            color: #475569;
            background: #f1f5f9;
            padding: 2px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
        }
        .remove-photo-check {
            font-size: 0.75rem;
            color: #ef4444;
            cursor: pointer;
            user-select: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 8px;
            border-radius: 6px;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            transition: all 0.2s ease;
        }
        .remove-photo-check:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.35);
        }
        .remove-photo-check .form-check-input {
            margin: 0 !important;
            float: none !important;
            cursor: pointer;
            width: 14px;
            height: 14px;
            accent-color: #ef4444;
        }
        .remove-photo-check .form-check-label {
            margin: 0 !important;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            line-height: 1;
        }
        .remove-photo-check input:checked ~ .form-check-label span {
            text-decoration: line-through;
            color: #dc2626;
            font-weight: 600;
        }
        body[data-theme="dark"] .photo-upload-card {
            background: #0b1120 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        body[data-theme="dark"] .photo-upload-card:hover {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
        body[data-theme="dark"] .modal-photo-preview-box {
            border-color: rgba(255, 255, 255, 0.15) !important;
            background-color: #020617 !important;
        }
        body[data-theme="dark"] .image-specs-badge {
            background: #1e293b !important;
            color: #94a3b8 !important;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        body[data-theme="dark"] .remove-photo-check {
            background: rgba(239, 68, 68, 0.12) !important;
            border-color: rgba(239, 68, 68, 0.25) !important;
            color: #f87171 !important;
        }
        body[data-theme="dark"] .remove-photo-check:hover {
            background: rgba(239, 68, 68, 0.22) !important;
            border-color: rgba(239, 68, 68, 0.4) !important;
        }

        /* Password Field & Security Card Styles (100% Matched with Coach Dashboard) */
        .security-subcard {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .security-subcard:hover {
            border-color: #cbd5e1;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .security-subcard .input-group .form-control {
            border-color: #cbd5e1;
        }
        .security-subcard .input-group .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }
        .password-toggle-btn {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #64748b;
            padding: 0.375rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .password-toggle-btn:hover {
            background: #f1f5f9;
            color: #1e293b;
            border-color: #94a3b8;
        }
        .input-group:focus-within .password-toggle-btn {
            border-color: #3b82f6;
        }
        body[data-theme="dark"] .security-subcard {
            background: #0b1120 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        body[data-theme="dark"] .security-subcard:hover {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
        body[data-theme="dark"] .security-subcard .input-group .form-control {
            border-color: rgba(255, 255, 255, 0.15) !important;
            background-color: #020617 !important;
            color: #f8fafc !important;
        }
        body[data-theme="dark"] .security-subcard .input-group .form-control:focus {
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 0.2rem rgba(56, 189, 248, 0.2) !important;
        }
        body[data-theme="dark"] .password-toggle-btn {
            background: #020617 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #94a3b8 !important;
        }
        body[data-theme="dark"] .password-toggle-btn:hover {
            background: #1e293b !important;
            color: #38bdf8 !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
        }
        body[data-theme="dark"] .input-group:focus-within .password-toggle-btn {
            border-color: #38bdf8 !important;
        }

        /* Modal & Tabs Mobile Responsiveness - Industry Standard */
        #editProfileModal .modal-dialog {
            max-width: 800px;
        }
        #editProfileModal .modal-content {
            max-width: 100%;
            overflow: hidden;
        }
        #editProfileModal .modal-body {
            overflow-x: hidden !important;
            padding: 1.25rem;
            max-width: 100%;
            box-sizing: border-box;
        }
        #editProfileModal .nav-tabs {
            border-bottom: 2px solid #e2e8f0;
            gap: 4px;
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 4px;
        }
        #editProfileModal .nav-tabs .nav-item {
            flex-shrink: 0;
        }
        #editProfileModal .nav-tabs .nav-link {
            border-radius: 8px 8px 0 0;
            font-size: 0.88rem;
            padding: 8px 14px;
            color: #64748b;
            border: 1px solid transparent;
            white-space: nowrap;
        }
        #editProfileModal .nav-tabs .nav-link.active {
            color: #2563eb;
            font-weight: 600;
            border-color: #e2e8f0 #e2e8f0 #ffffff;
            background-color: #ffffff;
        }
        #editProfileModal .photo-upload-card {
            max-width: 100%;
            overflow: hidden;
            box-sizing: border-box;
        }
        #editProfileModal input[type="file"].form-control {
            max-width: 100%;
            min-width: 0;
            font-size: 0.82rem;
        }
        #editProfileModal .image-specs-badge {
            max-width: 100%;
            white-space: normal;
            word-break: break-word;
            line-height: 1.3;
        }
        @media (max-width: 576px) {
            #editProfileModal .modal-dialog {
                margin: 0.5rem auto;
                width: calc(100% - 1rem);
                max-width: calc(100% - 1rem);
            }
            #editProfileModal .modal-body {
                padding: 0.85rem;
            }
            #editProfileModal .nav-tabs .nav-link {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            .photo-upload-card {
                padding: 12px 10px;
            }
            .photo-upload-card > .d-flex {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                gap: 0 !important;
            }
            /* 1. Title at the very top */
            .photo-upload-card .photo-title-header {
                width: 100%;
                text-align: center;
                margin-bottom: 12px !important;
            }
            .photo-upload-card .photo-title-header label.form-label {
                font-size: 0.95rem;
                font-weight: 700 !important;
                text-align: center;
                display: block;
                width: 100%;
                margin: 0 !important;
                letter-spacing: 0.3px;
            }
            /* 2. Photo preview image directly underneath title with balanced margin */
            .modal-photo-preview-box {
                width: 80px;
                height: 80px;
                margin: 0 auto 12px auto !important;
            }
            /* 3. Controls wrapper below preview */
            .photo-upload-card .photo-controls-wrap {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            /* 4. Specs info badge placed directly above Choose File input on mobile with clean breathing room */
            .photo-upload-card .photo-info-row {
                width: 100%;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                margin-bottom: 10px !important;
            }
            .photo-upload-card .image-specs-badge {
                font-size: 0.72rem;
                padding: 4px 10px;
                border-radius: 6px;
                display: inline-flex;
                margin: 0 auto !important;
            }
            /* 5. Choose file input */
            .photo-upload-card input[type="file"].form-control {
                width: 100%;
                margin: 0 0 10px 0 !important;
            }
            /* 6. Format text and remove button at bottom with proper spacing */
            .photo-upload-card .photo-footer-row {
                width: 100%;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                gap: 6px;
                margin-top: 2px !important;
            }

            /* Security Subcard Responsive on mobile */
            .security-subcard {
                padding: 12px 10px !important;
            }
            .security-subcard-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 3px !important;
                margin-bottom: 8px !important;
            }
            .security-subcard-header label {
                font-size: 0.88rem !important;
                white-space: nowrap !important;
            }
            .security-subcard-hint {
                font-size: 0.7rem !important;
                display: block;
            }
        }
        body[data-theme="dark"] #editProfileModal .nav-tabs {
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }
        body[data-theme="dark"] #editProfileModal .nav-tabs .nav-link {
            color: #94a3b8;
        }
        body[data-theme="dark"] #editProfileModal .nav-tabs .nav-link.active {
            color: #38bdf8;
            background-color: #0b1120;
            border-color: rgba(255, 255, 255, 0.1) rgba(255, 255, 255, 0.1) #0b1120;
        }
    </style>
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
</head>

<body>
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-3">
                <div>
                    <h1><i class="fas fa-tachometer-alt me-2"></i>Coach Dashboard</h1>
                    <p class="subtitle mb-0">
                        {{ ($contest && $contest->status == 1 && !empty($contest->title)) ? $contest->title : 'Your Contest Title' }}
                    </p>
                </div>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-end align-items-center gap-2 mt-2 mt-md-0 w-100 w-md-auto">
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-1"></i>Edit Profile
                    </button>
                    <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                    <button class="btn btn-outline-light btn-sm theme-toggle-btn d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 50%; padding: 0;">
                        <i class="fas fa-lightbulb theme-toggle-icon-light m-0"></i>
                        <i class="fas fa-moon theme-toggle-icon-dark m-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">
        <div id="dashboardAlertContainer">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="row mb-4 justify-content-center">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-users fa-2x text-primary"></i>
                    <h3>3</h3>
                    <p>Team Members</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-left-color: {{ $user->is_paid ? '#10b981' : '#ef4444' }};">
                    <i class="fas {{ $user->is_paid ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} fa-2x"></i>
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
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="info-label">Team Name</div>
                    <div class="info-value text-break">{{ $user->team_name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Institution Name</div>
                    <div class="info-value text-break">{{ $user->institute_name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Team ID</div>
                    <div class="info-value text-break">#{{ $user->team_id }}</div>
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
            <div class="row g-3">
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    @php
                        $hasCoachPhoto = !empty($user->coach_photo) && file_exists(public_path($user->coach_photo));
                        $coachAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->coach_name ?: 'Coach') . '&background=0D8ABC&color=fff&size=200&bold=true';
                    @endphp
                    <img src="{{ $hasCoachPhoto ? asset($user->coach_photo) : $coachAvatar }}" 
                        alt="{{ $user->coach_name }}" 
                        class="profile-image img-fluid shadow-sm"
                        onerror="this.onerror=null;this.src='{{ $coachAvatar }}';" />
                </div>
                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-label">Coach Name</div>
                            <div class="info-value text-break">{{ $user->coach_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Coach Email</div>
                            <div class="info-value text-break">{{ $user->coach_email }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Coach Phone</div>
                            <div class="info-value text-break">{{ $user->coach_phone }}</div>
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
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="member-card">
                        @php
                            $hasMem1Photo = !empty($user->mem_1_photo) && file_exists(public_path($user->mem_1_photo));
                            $mem1Avatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->mem_1_name ?: 'Member 1') . '&background=0D8ABC&color=fff&size=150&bold=true';
                        @endphp
                        <img src="{{ $hasMem1Photo ? asset($user->mem_1_photo) : $mem1Avatar }}"
                            alt="{{ $user->mem_1_name }}"
                            class="member-image img-fluid shadow-sm"
                            onerror="this.onerror=null;this.src='{{ $mem1Avatar }}';" />
                        <h6 class="text-break px-2">{{ $user->mem_1_name }}</h6>
                        <div class="text-start mt-3 px-2">
                            <div class="info-label">Student ID</div>
                            <div class="info-value text-break">{{ $user->mem_1_student_id }}</div>

                            <div class="info-label">Email</div>
                            <div class="info-value text-break">{{ $user->mem_1_email }}</div>

                            <div class="info-label">Phone</div>
                            <div class="info-value text-break">{{ $user->mem_1_phone }}</div>

                            <div class="info-label">T-Shirt</div>
                            <div class="info-value">{{ $user->mem_1_t_shirt }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="member-card">
                        @php
                            $hasMem2Photo = !empty($user->mem_2_photo) && file_exists(public_path($user->mem_2_photo));
                            $mem2Avatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->mem_2_name ?: 'Member 2') . '&background=0D8ABC&color=fff&size=150&bold=true';
                        @endphp
                        <img src="{{ $hasMem2Photo ? asset($user->mem_2_photo) : $mem2Avatar }}"
                            alt="{{ $user->mem_2_name }}"
                            class="member-image img-fluid shadow-sm"
                            onerror="this.onerror=null;this.src='{{ $mem2Avatar }}';" />
                        <h6 class="text-break px-2">{{ $user->mem_2_name }}</h6>
                        <div class="text-start mt-3 px-2">
                            <div class="info-label">Student ID</div>
                            <div class="info-value text-break">{{ $user->mem_2_student_id }}</div>

                            <div class="info-label">Email</div>
                            <div class="info-value text-break">{{ $user->mem_2_email }}</div>

                            <div class="info-label">Phone</div>
                            <div class="info-value text-break">{{ $user->mem_2_phone }}</div>

                            <div class="info-label">T-Shirt</div>
                            <div class="info-value">{{ $user->mem_2_t_shirt }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="member-card">
                        @php
                            $hasMem3Photo = !empty($user->mem_3_photo) && file_exists(public_path($user->mem_3_photo));
                            $mem3Avatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->mem_3_name ?: 'Member 3') . '&background=0D8ABC&color=fff&size=150&bold=true';
                        @endphp
                        <img src="{{ $hasMem3Photo ? asset($user->mem_3_photo) : $mem3Avatar }}"
                            alt="{{ $user->mem_3_name }}"
                            class="member-image img-fluid shadow-sm"
                            onerror="this.onerror=null;this.src='{{ $mem3Avatar }}';" />
                        <h6 class="text-break px-2">{{ $user->mem_3_name }}</h6>
                        <div class="text-start mt-3 px-2">
                            <div class="info-label">Student ID</div>
                            <div class="info-value text-break">{{ $user->mem_3_student_id }}</div>

                            <div class="info-label">Email</div>
                            <div class="info-value text-break">{{ $user->mem_3_email }}</div>

                            <div class="info-label">Phone</div>
                            <div class="info-value text-break">{{ $user->mem_3_phone }}</div>

                            <div class="info-label">T-Shirt</div>
                            <div class="info-value">{{ $user->mem_3_t_shirt }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($user->is_selected == 1)

            @if ($payment && $payment->transaction_id)

                <div class="transaction-section mt-4 overflow-hidden w-100">
                    @if ($payment->payment_status == 1)
                        <div class="alert alert-success border-0 shadow-sm overflow-hidden text-break text-wrap">
                            <h5 class="alert-heading fw-bold"><i class="fas fa-check-circle me-2"></i>Payment Approved!</h5>
                            <p class="mb-0">Congratulations! Your payment has been successfully verified and approved by the administration.</p>
                    @elseif ($payment->payment_status == 2)
                        <div class="alert alert-danger border-0 shadow-sm overflow-hidden text-break text-wrap">
                            <h5 class="alert-heading fw-bold"><i class="fas fa-times-circle me-2"></i>Payment Rejected!</h5>
                            <p class="mb-0">Unfortunately, your payment verification failed. Please contact the administration or submit a valid transaction ID.</p>
                    @else
                        <div class="alert alert-info border-0 shadow-sm overflow-hidden text-break text-wrap">
                            <h5 class="alert-heading fw-bold"><i class="fas fa-clock me-2"></i>Payment Pending Review</h5>
                            <p class="mb-0">You have successfully submitted your payment details. Please wait for admin verification.</p>
                    @endif
                        <hr>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <strong>Transaction ID:</strong> <br>
                                <span class="badge bg-light text-dark border text-wrap text-break">{{ $payment->transaction_id }}</span>
                            </div>
                            <div class="col-md-4">
                                <strong>Method:</strong> <br> {{ $payment->platform ?? 'N/A' }}
                            </div>
                            <div class="col-md-4">
                                <strong>Status:</strong> <br>
                                @if ($payment->payment_status == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($payment->payment_status == 2)
                                    <span class="badge bg-danger">Rejected</span>
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

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form id="editProfileForm" action="{{ route('coach.profile.update', [], false) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <!-- Hidden inputs for Base64 image payload (100% universal across all free & paid hosts) -->
                <input type="hidden" name="coach_photo_base64" id="coach_photo_base64">
                <input type="hidden" name="mem_1_photo_base64" id="mem_1_photo_base64">
                <input type="hidden" name="mem_2_photo_base64" id="mem_2_photo_base64">
                <input type="hidden" name="mem_3_photo_base64" id="mem_3_photo_base64">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Team Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
                                <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div id="modalAjaxAlert" class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3 d-none" role="alert">
                            <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</div>
                            <ul id="modalAjaxErrorList" class="mb-0 ps-3 small"></ul>
                            <button type="button" class="btn-close" onclick="document.getElementById('modalAjaxAlert').classList.add('d-none')"></button>
                        </div>

                        <ul class="nav nav-tabs mb-3 flex-nowrap text-nowrap overflow-x-auto pb-1" id="profileTabs" role="tablist" style="scrollbar-width: none; -webkit-overflow-scrolling: touch;">
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
                                        <input type="text" class="form-control coach-phone-input" name="coach_phone"
                                            value="{{ $user->coach_phone }}" required
                                            inputmode="tel" maxlength="20"
                                            placeholder="e.g., +8801700000000" autocomplete="tel">
                                        <div class="coach-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                        </div>
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
                                    <div class="col-12">
                                        <div class="photo-upload-card">
                                            @php
                                                $hasCoachModalPhoto = !empty($user->coach_photo) && file_exists(public_path($user->coach_photo));
                                            @endphp
                                            <div class="photo-title-header d-block d-sm-none text-center mb-2">
                                                <label class="form-label small fw-bold mb-0">Coach Photo</label>
                                            </div>
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <div class="modal-photo-preview-box">
                                                    <img id="coach-photo-preview"
                                                        src="{{ $hasCoachModalPhoto ? asset($user->coach_photo) : $coachAvatar }}"
                                                        data-default="{{ $coachAvatar }}"
                                                        data-saved-src="{{ $hasCoachModalPhoto ? asset($user->coach_photo) : '' }}"
                                                        alt="Coach Preview">
                                                    <span class="preview-overlay-tag">PREVIEW</span>
                                                </div>
                                                <div class="flex-grow-1 photo-controls-wrap">
                                                    <div class="d-none d-sm-flex flex-wrap justify-content-between align-items-center gap-2 mb-1">
                                                        <label class="form-label small fw-bold mb-0">Coach Photo</label>
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <div class="photo-info-row d-sm-none text-center mb-2">
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <input type="file" class="form-control form-control-sm photo-input-with-preview" name="coach_photo"
                                                        accept="image/jpeg,image/png,image/jpg,image/webp" data-preview="coach-photo-preview">
                                                    <div class="photo-footer-row d-flex flex-wrap justify-content-between align-items-center mt-1">
                                                        <span class="form-text small text-muted" style="font-size: 0.72rem;">JPG, JPEG, PNG, WEBP only.</span>
                                                        <div class="form-check remove-photo-check m-0 {{ $hasCoachModalPhoto ? '' : 'd-none' }}" id="coachPhotoActionWrap">
                                                            <input class="form-check-input remove-photo-trigger" type="checkbox" name="remove_coach_photo" value="1" id="removeCoachPhoto" data-preview="coach-photo-preview" data-saved="{{ $hasCoachModalPhoto ? '1' : '0' }}">
                                                            <label class="form-check-label small" for="removeCoachPhoto" id="removeCoachPhotoLabel">
                                                                <i class="fas fa-trash-alt me-1"></i> <span id="removeCoachPhotoText">{{ $hasCoachModalPhoto ? 'Remove photo' : 'Clear selection' }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="security-subcard">
                                            <div class="security-subcard-header d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-1 mb-2">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="fas fa-shield-alt text-primary flex-shrink-0"></i>
                                                    <label class="form-label small fw-bold mb-0 text-nowrap">Change Password</label>
                                                </div>
                                                <span class="text-muted security-subcard-hint" style="font-size: 0.75rem;">(Leave blank to keep current password)</span>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted mb-1">New Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control border-end-0" id="coachNewPassword" name="new_password" placeholder="At least 6 characters" autocomplete="new-password">
                                                        <button class="btn password-toggle-btn border border-start-0" type="button" onclick="togglePasswordVisibility('coachNewPassword', 'coachNewPasswordIcon')" title="Toggle visibility">
                                                            <i class="fas fa-eye-slash" id="coachNewPasswordIcon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted mb-1">Confirm Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control border-end-0" id="coachNewPasswordConfirm" name="new_password_confirmation" placeholder="Retype password" autocomplete="new-password">
                                                        <button class="btn password-toggle-btn border border-start-0" type="button" onclick="togglePasswordVisibility('coachNewPasswordConfirm', 'coachNewPasswordConfirmIcon')" title="Toggle visibility">
                                                            <i class="fas fa-eye-slash" id="coachNewPasswordConfirmIcon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mem1" role="tabpanel">
                                <h6 class="text-primary mb-3">Member 1 Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mem_1_name"
                                            value="{{ $user->mem_1_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Student ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mem_1_student_id"
                                            value="{{ $user->mem_1_student_id }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="mem_1_email"
                                            value="{{ $user->mem_1_email }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control coach-phone-input" name="mem_1_phone"
                                            value="{{ $user->mem_1_phone }}"
                                            inputmode="tel" maxlength="20"
                                            placeholder="e.g., +8801700000000" autocomplete="tel">
                                        <div class="coach-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                        </div>
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
                                    <div class="col-12">
                                        <div class="photo-upload-card">
                                            <div class="photo-title-header d-block d-sm-none text-center mb-2">
                                                <label class="form-label small fw-bold mb-0">Member 1 Photo</label>
                                            </div>
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <div class="modal-photo-preview-box">
                                                    <img id="mem1-photo-preview"
                                                        src="{{ $hasMem1Photo ? asset($user->mem_1_photo) : $mem1Avatar }}"
                                                        data-default="{{ $mem1Avatar }}"
                                                        data-saved-src="{{ $hasMem1Photo ? asset($user->mem_1_photo) : '' }}"
                                                        alt="Member 1 Preview">
                                                    <span class="preview-overlay-tag">PREVIEW</span>
                                                </div>
                                                <div class="flex-grow-1 photo-controls-wrap">
                                                    <div class="d-none d-sm-flex flex-wrap justify-content-between align-items-center gap-2 mb-1">
                                                        <label class="form-label small fw-bold mb-0">Member 1 Photo</label>
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <div class="photo-info-row d-sm-none text-center mb-2">
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <input type="file" class="form-control form-control-sm photo-input-with-preview" name="mem_1_photo"
                                                        accept="image/jpeg,image/png,image/jpg,image/webp" data-preview="mem1-photo-preview">
                                                    <div class="photo-footer-row d-flex flex-wrap justify-content-between align-items-center mt-1">
                                                        <span class="form-text small text-muted" style="font-size: 0.72rem;">JPG, JPEG, PNG, WEBP only.</span>
                                                        <div class="form-check remove-photo-check m-0 {{ $hasMem1Photo ? '' : 'd-none' }}" id="mem1PhotoActionWrap">
                                                            <input class="form-check-input remove-photo-trigger" type="checkbox" name="remove_mem_1_photo" value="1" id="removeMem1Photo" data-preview="mem1-photo-preview" data-saved="{{ $hasMem1Photo ? '1' : '0' }}">
                                                            <label class="form-check-label small" for="removeMem1Photo" id="removeMem1PhotoLabel">
                                                                <i class="fas fa-trash-alt me-1"></i> <span id="removeMem1PhotoText">{{ $hasMem1Photo ? 'Remove photo' : 'Clear selection' }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mem2" role="tabpanel">
                                <h6 class="text-primary mb-3">Member 2 Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mem_2_name"
                                            value="{{ $user->mem_2_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Student ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mem_2_student_id"
                                            value="{{ $user->mem_2_student_id }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="mem_2_email"
                                            value="{{ $user->mem_2_email }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control coach-phone-input" name="mem_2_phone"
                                            value="{{ $user->mem_2_phone }}"
                                            inputmode="tel" maxlength="20"
                                            placeholder="e.g., +8801700000000" autocomplete="tel">
                                        <div class="coach-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                             <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                        </div>
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
                                    <div class="col-12">
                                        <div class="photo-upload-card">
                                            <div class="photo-title-header d-block d-sm-none text-center mb-2">
                                                <label class="form-label small fw-bold mb-0">Member 2 Photo</label>
                                            </div>
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <div class="modal-photo-preview-box">
                                                    <img id="mem2-photo-preview"
                                                        src="{{ $hasMem2Photo ? asset($user->mem_2_photo) : $mem2Avatar }}"
                                                        data-default="{{ $mem2Avatar }}"
                                                        data-saved-src="{{ $hasMem2Photo ? asset($user->mem_2_photo) : '' }}"
                                                        alt="Member 2 Preview">
                                                    <span class="preview-overlay-tag">PREVIEW</span>
                                                </div>
                                                <div class="flex-grow-1 photo-controls-wrap">
                                                    <div class="d-none d-sm-flex flex-wrap justify-content-between align-items-center gap-2 mb-1">
                                                        <label class="form-label small fw-bold mb-0">Member 2 Photo</label>
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <div class="photo-info-row d-sm-none text-center mb-2">
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <input type="file" class="form-control form-control-sm photo-input-with-preview" name="mem_2_photo"
                                                        accept="image/jpeg,image/png,image/jpg,image/webp" data-preview="mem2-photo-preview">
                                                    <div class="photo-footer-row d-flex flex-wrap justify-content-between align-items-center mt-1">
                                                        <span class="form-text small text-muted" style="font-size: 0.72rem;">JPG, JPEG, PNG, WEBP only.</span>
                                                        <div class="form-check remove-photo-check m-0 {{ $hasMem2Photo ? '' : 'd-none' }}" id="mem2PhotoActionWrap">
                                                            <input class="form-check-input remove-photo-trigger" type="checkbox" name="remove_mem_2_photo" value="1" id="removeMem2Photo" data-preview="mem2-photo-preview" data-saved="{{ $hasMem2Photo ? '1' : '0' }}">
                                                            <label class="form-check-label small" for="removeMem2Photo" id="removeMem2PhotoLabel">
                                                                <i class="fas fa-trash-alt me-1"></i> <span id="removeMem2PhotoText">{{ $hasMem2Photo ? 'Remove photo' : 'Clear selection' }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="mem3" role="tabpanel">
                                <h6 class="text-primary mb-3">Member 3 Details</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mem_3_name"
                                            value="{{ $user->mem_3_name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Student ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mem_3_student_id"
                                            value="{{ $user->mem_3_student_id }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="mem_3_email"
                                            value="{{ $user->mem_3_email }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Phone</label>
                                        <input type="text" class="form-control coach-phone-input" name="mem_3_phone"
                                            value="{{ $user->mem_3_phone }}"
                                            inputmode="tel" maxlength="20"
                                            placeholder="e.g., +8801700000000" autocomplete="tel">
                                        <div class="coach-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                             <i class="fas fa-exclamation-triangle me-1"></i> Letters & symbols aren't allowed. Only 0-9, + and - are accepted.
                                        </div>
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
                                    <div class="col-12">
                                        <div class="photo-upload-card">
                                            <div class="photo-title-header d-block d-sm-none text-center mb-2">
                                                <label class="form-label small fw-bold mb-0">Member 3 Photo</label>
                                            </div>
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                                <div class="modal-photo-preview-box">
                                                    <img id="mem3-photo-preview"
                                                        src="{{ $hasMem3Photo ? asset($user->mem_3_photo) : $mem3Avatar }}"
                                                        data-default="{{ $mem3Avatar }}"
                                                        data-saved-src="{{ $hasMem3Photo ? asset($user->mem_3_photo) : '' }}"
                                                        alt="Member 3 Preview">
                                                    <span class="preview-overlay-tag">PREVIEW</span>
                                                </div>
                                                <div class="flex-grow-1 photo-controls-wrap">
                                                    <div class="d-none d-sm-flex flex-wrap justify-content-between align-items-center gap-2 mb-1">
                                                        <label class="form-label small fw-bold mb-0">Member 3 Photo</label>
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <div class="photo-info-row d-sm-none text-center mb-2">
                                                        <span class="image-specs-badge"><i class="fas fa-info-circle me-1 text-primary"></i>300&times;300 px (1:1 Square) &bull; Max 2MB</span>
                                                    </div>
                                                    <input type="file" class="form-control form-control-sm photo-input-with-preview" name="mem_3_photo"
                                                        accept="image/jpeg,image/png,image/jpg,image/webp" data-preview="mem3-photo-preview">
                                                    <div class="photo-footer-row d-flex flex-wrap justify-content-between align-items-center mt-1">
                                                        <span class="form-text small text-muted" style="font-size: 0.72rem;">JPG, JPEG, PNG, WEBP only.</span>
                                                        <div class="form-check remove-photo-check m-0 {{ $hasMem3Photo ? '' : 'd-none' }}" id="mem3PhotoActionWrap">
                                                            <input class="form-check-input remove-photo-trigger" type="checkbox" name="remove_mem_3_photo" value="1" id="removeMem3Photo" data-preview="mem3-photo-preview" data-saved="{{ $hasMem3Photo ? '1' : '0' }}">
                                                            <label class="form-check-label small" for="removeMem3Photo" id="removeMem3PhotoLabel">
                                                                <i class="fas fa-trash-alt me-1"></i> <span id="removeMem3PhotoText">{{ $hasMem3Photo ? 'Remove photo' : 'Clear selection' }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="updateProfileSubmitBtn" class="btn btn-primary px-4">
                            <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                            <span class="btn-text">Update</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap & App Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('content/website') }}/js/dark-mode.js"></script>
    <script>
        // Website In-Page Dashboard Alert
        function showWebsiteToast(message, type = 'success', duration = 6000) {
            const container = document.getElementById('dashboardAlertContainer');
            if (!container) return;

            container.innerHTML = '';

            const isSuccess = (type === 'success');
            const alertClass = isSuccess ? 'alert-success' : (type === 'warning' ? 'alert-warning' : 'alert-danger');
            const iconClass = isSuccess ? 'fa-check-circle' : (type === 'warning' ? 'fa-exclamation-triangle' : 'fa-exclamation-circle');

            const alertEl = document.createElement('div');
            alertEl.className = `alert ${alertClass} alert-dismissible fade show border-0 shadow-sm mb-4`;
            alertEl.setAttribute('role', 'alert');
            alertEl.innerHTML = `
                <i class="fas ${iconClass} me-2"></i> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            container.appendChild(alertEl);
            alertEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

            if (duration > 0) {
                setTimeout(function() {
                    if (alertEl && alertEl.parentElement) {
                        alertEl.classList.remove('show');
                        setTimeout(() => alertEl.remove(), 250);
                    }
                }, duration);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Auto open Edit Profile Modal if validation errors exist and switch to relevant tab
            @if ($errors->any())
                const editModalEl = document.getElementById('editProfileModal');
                if (editModalEl) {
                    const editModal = new bootstrap.Modal(editModalEl);
                    editModal.show();

                    // Switch tab to the first errored section
                    @if ($errors->has('coach_*') || $errors->has('new_password'))
                        const tabBtn = document.getElementById('coach-tab');
                        if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                    @elseif ($errors->has('mem_1_*'))
                        const tabBtn = document.getElementById('mem1-tab');
                        if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                    @elseif ($errors->has('mem_2_*'))
                        const tabBtn = document.getElementById('mem2-tab');
                        if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                    @elseif ($errors->has('mem_3_*'))
                        const tabBtn = document.getElementById('mem3-tab');
                        if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                    @endif
                }
            @endif

            // Check for pending notification from previous AJAX reload
            const pendingToast = sessionStorage.getItem('pending_toast');
            if (pendingToast) {
                try {
                    const toastData = JSON.parse(pendingToast);
                    showWebsiteToast(toastData.message, toastData.type || 'success');
                } catch(e) {}
                sessionStorage.removeItem('pending_toast');
            }

            // Coach Dashboard Phone Input Restriction (Digits, +, and - only)
            document.querySelectorAll('.coach-phone-input').forEach(function(input) {
                const container = input.parentElement;
                const alertNotice = container ? container.querySelector('.coach-phone-alert') : null;
                let alertTimeout = null;

                function showInvalidWarning() {
                    if (alertNotice) {
                        alertNotice.classList.remove('d-none');
                    }
                    input.classList.add('coach-phone-shake');
                    clearTimeout(alertTimeout);
                    alertTimeout = setTimeout(function() {
                        input.classList.remove('coach-phone-shake');
                        if (alertNotice) {
                            alertNotice.classList.add('d-none');
                        }
                    }, 2800);
                }

                function sanitize() {
                    const originalVal = input.value;
                    const cleanedVal = originalVal.replace(/[^0-9+\-]/g, '');
                    if (originalVal !== cleanedVal) {
                        input.value = cleanedVal;
                        showInvalidWarning();
                    }
                }

                input.addEventListener('input', sanitize);
                input.addEventListener('blur', sanitize);

                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which || e.keyCode);
                    // Allow 0-9, +, - and control keys (backspace, enter, arrow keys)
                    if (!/[0-9+\-]/.test(char) && e.which !== 0 && e.which !== 8 && e.which !== 13) {
                        e.preventDefault();
                        showInvalidWarning();
                    }
                });

                input.addEventListener('paste', function(e) {
                    const pastedData = (e.clipboardData || window.clipboardData).getData('text');
                    if (/[^0-9+\-]/.test(pastedData)) {
                        e.preventDefault();
                        const filteredData = pastedData.replace(/[^0-9+\-]/g, '');
                        const start = input.selectionStart || 0;
                        const end = input.selectionEnd || 0;
                        const currentVal = input.value;
                        const newVal = currentVal.substring(0, start) + filteredData + currentVal.substring(end);
                        input.value = newVal.slice(0, 20);
                        showInvalidWarning();
                    }
                });
            });

            // Coach Profile Update Form Submission
            const profileForm = document.getElementById('editProfileForm');
            const submitBtn = document.getElementById('updateProfileSubmitBtn');
            const ajaxAlert = document.getElementById('modalAjaxAlert');
            const ajaxErrorList = document.getElementById('modalAjaxErrorList');

            if (profileForm && submitBtn) {
                profileForm.addEventListener('submit', function(e) {
                    // Client-side quick check before send
                    const requiredInputs = profileForm.querySelectorAll('input[required]');
                    const tabNames = {
                        'coach': 'Coach Info',
                        'mem1': 'Member 1',
                        'mem2': 'Member 2',
                        'mem3': 'Member 3'
                    };

                    const missingFields = [];
                    let hasMissing = false;
                    requiredInputs.forEach(function(inp) {
                        if (!inp.value.trim()) {
                            hasMissing = true;
                            inp.classList.add('is-invalid');
                            const label = inp.closest('.col-md-6, .col-12')?.querySelector('label')?.textContent?.replace('*', '')?.trim() || inp.name;
                            const tabPane = inp.closest('.tab-pane');
                            const tabLabel = (tabPane && tabNames[tabPane.id]) ? tabNames[tabPane.id] : 'Coach';
                            
                            // Clean phrasing like "Member 1 name is required." or "Coach name is required."
                            let cleanLabel = label.toLowerCase().replace(/^(coach|member\s*[123])\s*/i, '').trim();
                            let errorMsg = `${tabLabel} ${cleanLabel} is required.`;
                            if (tabLabel === 'Coach Info') {
                                errorMsg = `Coach ${cleanLabel} is required.`;
                            }

                            missingFields.push({ input: inp, msg: errorMsg, tabId: tabPane ? tabPane.id : null });
                        } else {
                            inp.classList.remove('is-invalid');
                        }
                    });

                    if (hasMissing) {
                        e.preventDefault();

                        // List inside modal alert box (Only inside the form)
                        if (ajaxAlert && ajaxErrorList) {
                            ajaxErrorList.innerHTML = missingFields.map(f => `<li>${f.msg}</li>`).join('');
                            ajaxAlert.classList.remove('d-none');
                            const modalBody = profileForm.querySelector('.modal-body');
                            if (modalBody) modalBody.scrollTop = 0;
                        }

                        // Automatically switch to the tab containing the first missing input
                        const first = missingFields[0];
                        if (first.tabId) {
                            const tabTrigger = document.querySelector(`[data-bs-target="#${first.tabId}"]`);
                            if (tabTrigger) {
                                bootstrap.Tab.getOrCreateInstance(tabTrigger).show();
                            }
                        }
                        first.input.focus();
                        return;
                    }

                    e.preventDefault();

                    // Client-side quick password confirmation check
                    const newPass = document.getElementById('coachNewPassword')?.value || '';
                    const confirmPass = document.getElementById('coachNewPasswordConfirm')?.value || '';
                    if (newPass && newPass.length < 6) {
                        if (ajaxAlert && ajaxErrorList) {
                            ajaxErrorList.innerHTML = '<li>New password must be at least 6 characters.</li>';
                            ajaxAlert.classList.remove('d-none');
                            const modalBody = profileForm.querySelector('.modal-body');
                            if (modalBody) modalBody.scrollTop = 0;
                        }
                        const tabBtn = document.getElementById('coach-tab');
                        if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                        document.getElementById('coachNewPassword').focus();
                        return;
                    }
                    if (newPass && newPass !== confirmPass) {
                        if (ajaxAlert && ajaxErrorList) {
                            ajaxErrorList.innerHTML = '<li>Confirm password does not match new password.</li>';
                            ajaxAlert.classList.remove('d-none');
                            const modalBody = profileForm.querySelector('.modal-body');
                            if (modalBody) modalBody.scrollTop = 0;
                        }
                        const tabBtn = document.getElementById('coach-tab');
                        if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                        document.getElementById('coachNewPasswordConfirm').focus();
                        return;
                    }

                    // UI Loading state
                    const spinner = submitBtn.querySelector('.spinner-border');
                    const btnText = submitBtn.querySelector('.btn-text');
                    submitBtn.disabled = true;
                    if (spinner) spinner.classList.remove('d-none');
                    if (btnText) btnText.textContent = 'Updating...';

                    // Prepare form data using application/x-www-form-urlencoded
                    const formData = new FormData(profileForm);
                    // Remove raw file inputs to ensure Base64 universal host compatibility
                    formData.delete('coach_photo');
                    formData.delete('mem_1_photo');
                    formData.delete('mem_2_photo');
                    formData.delete('mem_3_photo');

                    const urlEncodedData = new URLSearchParams(formData).toString();

                    fetch(profileForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': profileForm.querySelector('input[name="_token"]').value
                        },
                        body: urlEncodedData
                    })
                    .then(async function(response) {
                        const data = await response.json();
                        if (response.ok && data.success) {
                            // Save success toast and reload smoothly to reflect new state
                            sessionStorage.setItem('pending_toast', JSON.stringify({
                                message: data.message || 'Profile & Team Information Updated Successfully!',
                                type: 'success'
                            }));
                            window.location.reload();
                        } else {
                            // Reset submit button state
                            submitBtn.disabled = false;
                            if (spinner) spinner.classList.add('d-none');
                            if (btnText) btnText.textContent = 'Update';

                            // Extract error messages
                            let errorItems = [];
                            if (data.errors) {
                                Object.keys(data.errors).forEach(function(key) {
                                    data.errors[key].forEach(function(msg) {
                                        errorItems.push(msg);
                                    });
                                });
                            } else if (data.message) {
                                errorItems.push(data.message);
                            } else {
                                errorItems.push('An unexpected error occurred. Please try again.');
                            }

                            // Show error inside modal without reloading page
                            if (ajaxAlert && ajaxErrorList) {
                                ajaxErrorList.innerHTML = errorItems.map(msg => `<li>${msg}</li>`).join('');
                                ajaxAlert.classList.remove('d-none');
                                const modalBody = profileForm.querySelector('.modal-body');
                                if (modalBody) modalBody.scrollTop = 0;
                            }

                            // Auto focus Coach Tab if password error
                            if (data.errors && data.errors.new_password) {
                                const tabBtn = document.getElementById('coach-tab');
                                if (tabBtn) bootstrap.Tab.getOrCreateInstance(tabBtn).show();
                                const passInp = document.getElementById('coachNewPassword');
                                if (passInp) passInp.focus();
                            }
                        }
                    })
                    .catch(function(err) {
                        submitBtn.disabled = false;
                        if (spinner) spinner.classList.add('d-none');
                        if (btnText) btnText.textContent = 'Update';

                        if (ajaxAlert && ajaxErrorList) {
                            ajaxErrorList.innerHTML = '<li>Unable to process request. Please check your internet connection and try again.</li>';
                            ajaxAlert.classList.remove('d-none');
                            const modalBody = profileForm.querySelector('.modal-body');
                            if (modalBody) modalBody.scrollTop = 0;
                        }
                    });
                });
            }

            // Live Photo Preview and Client-side file type & size validation
            document.querySelectorAll('.photo-input-with-preview').forEach(function(fileInput) {
                fileInput.addEventListener('change', function() {
                    const targetPreviewId = fileInput.getAttribute('data-preview');
                    const imgEl = document.getElementById(targetPreviewId);
                    const file = fileInput.files && fileInput.files[0];

                    if (!file) return;

                    // Strictly check file MIME type and extension
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                    const validExts = ['.jpg', '.jpeg', '.png', '.webp'];
                    const fileName = file.name.toLowerCase();
                    const hasValidExt = validExts.some(function(ext) { return fileName.endsWith(ext); });

                    if (!validTypes.includes(file.type) && !hasValidExt) {
                        if (ajaxAlert && ajaxErrorList) {
                            ajaxErrorList.innerHTML = '<li>Invalid file format! Only images (JPG, JPEG, PNG, WEBP) are allowed.</li>';
                            ajaxAlert.classList.remove('d-none');
                            const modalBody = fileInput.closest('.modal-body');
                            if (modalBody) modalBody.scrollTop = 0;
                        }
                        fileInput.value = '';
                        return;
                    }

                    // Max 2MB validation
                    if (file.size > 2 * 1024 * 1024) {
                        if (ajaxAlert && ajaxErrorList) {
                            ajaxErrorList.innerHTML = '<li>Image size exceeds 2MB limit. Please upload a photo smaller than 2MB.</li>';
                            ajaxAlert.classList.remove('d-none');
                            const modalBody = fileInput.closest('.modal-body');
                            if (modalBody) modalBody.scrollTop = 0;
                        }
                        fileInput.value = '';
                        return;
                    }

                    // Show image preview and save to hidden Base64 input
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (imgEl) {
                            imgEl.src = e.target.result;
                        }
                        const b64Map = {
                            'coach-photo-preview': 'coach_photo_base64',
                            'mem1-photo-preview': 'mem_1_photo_base64',
                            'mem2-photo-preview': 'mem_2_photo_base64',
                            'mem3-photo-preview': 'mem_3_photo_base64'
                        };
                        const targetHiddenId = b64Map[targetPreviewId];
                        if (targetHiddenId) {
                            const hiddenInput = document.getElementById(targetHiddenId);
                            if (hiddenInput) hiddenInput.value = e.target.result;
                        }
                    };
                    reader.readAsDataURL(file);

                    // Reveal clear/remove option immediately
                    const card = fileInput.closest('.photo-upload-card');
                    const actionWrap = card ? card.querySelector('.remove-photo-check') : document.getElementById(targetPreviewId.replace('-preview', 'PhotoActionWrap'));
                    const removeCheck = card ? card.querySelector('.remove-photo-trigger') : null;
                    const labelSpan = card ? card.querySelector('.remove-photo-check label span') : null;

                    if (actionWrap) {
                        actionWrap.classList.remove('d-none');
                        actionWrap.style.setProperty('display', 'inline-flex', 'important');
                    }
                    if (removeCheck) {
                        removeCheck.checked = false;
                        const hasSaved = removeCheck.getAttribute('data-saved') === '1';
                        if (labelSpan) {
                            labelSpan.textContent = hasSaved ? 'Cancel new photo' : 'Clear selection';
                        }
                    }
                });
            });

            // Remove photo / Clear selection handler
            document.querySelectorAll('.remove-photo-trigger').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const targetPreviewId = checkbox.getAttribute('data-preview');
                    const imgEl = document.getElementById(targetPreviewId);
                    const card = checkbox.closest('.photo-upload-card');
                    const fileInput = card ? card.querySelector('.photo-input-with-preview') : null;
                    const actionWrap = card ? card.querySelector('.remove-photo-check') : document.getElementById(targetPreviewId.replace('-preview', 'PhotoActionWrap'));
                    const labelSpan = card ? card.querySelector('.remove-photo-check label span') : null;
                    const hasSaved = checkbox.getAttribute('data-saved') === '1';

                    const b64Map = {
                        'coach-photo-preview': 'coach_photo_base64',
                        'mem1-photo-preview': 'mem_1_photo_base64',
                        'mem2-photo-preview': 'mem_2_photo_base64',
                        'mem3-photo-preview': 'mem_3_photo_base64'
                    };
                    const targetHiddenId = b64Map[targetPreviewId];
                    if (targetHiddenId) {
                        const hiddenInput = document.getElementById(targetHiddenId);
                        if (hiddenInput) hiddenInput.value = '';
                    }

                    if (checkbox.checked) {
                        if (!hasSaved) {
                            // No saved photo in DB: immediately clear chosen file and reset UI
                            if (fileInput) fileInput.value = '';
                            checkbox.checked = false;
                            if (actionWrap) {
                                actionWrap.classList.add('d-none');
                                actionWrap.style.setProperty('display', 'none', 'important');
                            }
                            if (imgEl && imgEl.hasAttribute('data-default')) {
                                imgEl.src = imgEl.getAttribute('data-default');
                            }
                        } else {
                            // Saved photo exists in DB
                            if (fileInput && fileInput.files && fileInput.files.length > 0) {
                                // Revert newly chosen file back to the saved DB photo
                                fileInput.value = '';
                                checkbox.checked = false;
                                if (labelSpan) labelSpan.textContent = 'Remove photo';
                                const origSavedSrc = imgEl ? imgEl.getAttribute('data-saved-src') : '';
                                if (origSavedSrc && imgEl) {
                                    imgEl.src = origSavedSrc;
                                }
                            } else {
                                // User actively checked to delete the existing saved photo
                                if (imgEl && imgEl.hasAttribute('data-default')) {
                                    imgEl.src = imgEl.getAttribute('data-default');
                                }
                            }
                        }
                    } else {
                        // Unchecked
                        if (hasSaved) {
                            const origSavedSrc = imgEl ? imgEl.getAttribute('data-saved-src') : '';
                            if (origSavedSrc && imgEl) {
                                imgEl.src = origSavedSrc;
                            } else if (imgEl && imgEl.hasAttribute('data-default')) {
                                imgEl.src = imgEl.getAttribute('data-default');
                            }
                        } else {
                            if (imgEl && imgEl.hasAttribute('data-default')) {
                                imgEl.src = imgEl.getAttribute('data-default');
                            }
                        }
                    }
                });
            });
        });

        // Toggle password visibility with eye / eye-slash icon
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>

</html>
    