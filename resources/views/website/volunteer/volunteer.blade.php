<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - {{ $setting->website_name ?? 'Your Website Name' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->volunteer_favicon) ? asset($setting->volunteer_favicon) : (!empty($setting->website_favicon) ? asset($setting->website_favicon) : asset('content/website/image/favicon.ico')) }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/volunteer_dashboard.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/dark-mode.css">
    <style>
        /* Exact Match with Website Standard Alert Style Toast */
        .toast-container {
            max-width: 100vw;
            box-sizing: border-box;
        }
        #volunteerToast {
            max-width: 360px;
            width: auto;
            border-radius: 8px;
            font-size: 0.92rem;
            font-weight: 500;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        /* Mobile / Small Screens Fix (even down to 200px - 320px) */
        @media (max-width: 576px) {
            .toast-container {
                top: 10px !important;
                right: 10px !important;
                left: 10px !important;
                padding: 0 !important;
                width: calc(100% - 20px) !important;
            }
            #volunteerToast {
                width: 100% !important;
                max-width: 100% !important;
                font-size: 0.85rem;
            }
            #volunteerToast .toast-body {
                word-break: break-word;
                overflow-wrap: break-word;
                padding: 10px 12px;
            }
        }
        /* Light Mode - Exact colors as 2nd picture */
        #volunteerToast.bg-success {
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
            border: 1px solid #badbcc !important;
        }
        #volunteerToast.bg-danger {
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
        }
        #volunteerToast.bg-warning {
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
        }

        /* Dark Mode - Identical to 2nd picture alert style */
        body[data-theme="dark"] #volunteerToast.bg-success {
            background-color: #d1e7dd !important;
            color: #0f5132 !important;
            border: 1px solid #badbcc !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6) !important;
        }
        body[data-theme="dark"] #volunteerToast.bg-success i {
            color: #0f5132 !important;
        }
        body[data-theme="dark"] #volunteerToast.bg-danger {
            background-color: #f8d7da !important;
            color: #842029 !important;
            border: 1px solid #f5c2c7 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6) !important;
        }
        body[data-theme="dark"] #volunteerToast.bg-warning {
            background-color: #fff3cd !important;
            color: #664d03 !important;
            border: 1px solid #ffecb5 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6) !important;
        }
        body[data-theme="dark"] #volunteerToast .btn-close {
            filter: none !important;
            opacity: 0.75 !important;
        }

        /* Kit Action Buttons - Mobile UX Optimization (Save on top, full width, touch friendly) */
        @media (max-width: 575.98px) {
            .kit-action-buttons-wrap {
                width: 100%;
            }
            .kit-action-buttons-wrap .btn {
                width: 100% !important;
                padding: 10px 16px !important;
                font-size: 0.95rem !important;
                font-weight: 500;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* Kit Status Dropdown - Clean Industry Standard & Design Consistency */
        /* Light Mode: Standard natural disabled & active form-select styles */
        .kit-status-select:disabled {
            background-color: #e9ecef !important;
            color: #495057 !important;
            border-color: #ced4da !important;
            cursor: not-allowed !important;
            opacity: 0.85 !important;
        }

        .kit-status-select:not(:disabled) {
            background-color: #ffffff;
            color: #212529;
            border: 1px solid #0d6efd;
            box-shadow: 0 1px 3px rgba(13, 110, 253, 0.15);
            cursor: pointer;
        }

        /* Dark Mode: Perfect contrast without breaking website design consistency */
        body[data-theme="dark"] .kit-status-select:disabled {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #94a3b8 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: none !important;
            cursor: not-allowed !important;
            opacity: 0.7 !important;
        }

        body[data-theme="dark"] .kit-status-select:not(:disabled) {
            background-color: #020617 !important;
            color: #ffffff !important;
            border: 1px solid #3b82f6 !important;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25) !important;
            cursor: pointer !important;
        }

        body[data-theme="dark"] .kit-status-select:not(:disabled):hover {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.35) !important;
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
                    <h1><i class="fas fa-hands-helping me-2"></i>Volunteer Dashboard</h1>
                    <p class="subtitle mb-0">
                        {{ ($contest && $contest->status == 1 && !empty($contest->title)) ? $contest->title : 'Your Contest Title' }}
                    </p>
                </div>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-end align-items-center gap-2 mt-2 mt-md-0 w-100 w-md-auto">
                    <form action="{{ route('user.logout') }}" method="POST" class="d-inline-flex align-items-center m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                    <button class="btn btn-outline-light btn-sm theme-toggle-btn d-flex align-items-center justify-content-center" style="width: 31px; height: 31px; border-radius: 50%; padding: 0;">
                        <i class="fas fa-lightbulb theme-toggle-icon-light m-0"></i>
                        <i class="fas fa-moon theme-toggle-icon-dark m-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">

        <div class="row mb-4 justify-content-center">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <i class="fas fa-id-badge fa-2x" style="color: #7c3aed;"></i>
                    <h3>#{{ $volunteer->volunteer_id }}</h3>
                    <p>Volunteer ID</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-left-color: {{ $volunteer->status == 1 ? '#10b981' : '#ef4444' }};">
                    <i class="fas {{ $volunteer->status == 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} fa-2x"></i>
                    <h3>{{ $volunteer->status == 1 ? 'Active' : 'Inactive' }}</h3>
                    <p>Status</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-left-color: #3b82f6;">
                    <i class="fas fa-users fa-2x text-primary"></i>
                    <h3>{{ count($teams) }}</h3>
                    <p>Total Teams</p>
                </div>
            </div>
        </div>
        <div class="view-only-notice">
            <i class="fas fa-info-circle"></i>
            <strong>Note:</strong> To Update Any Personal Information, Please Contact With Admin.
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-user-circle"></i>
                <h5>My Information</h5>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="info-label">Full Name</div>
                    <div class="info-value text-break">{{ $volunteer->name }}</div>
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="info-label">Email Address</div>
                    <div class="info-value text-break">{{ $volunteer->email }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value text-break">{{ $volunteer->phone }}</div>
                </div>

            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-bell" style="color: #f59e0b;"></i>
                <h5>Message from Admin</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(!empty($volunteer->volunteer_notice))
                        <div class="alert alert-info d-flex align-items-start mb-0 admin-message-box" role="alert" style="border-left: 4px solid #0ea5e9; border-radius: 0.5rem;">
                            <i class="fas fa-bullhorn fa-lg me-3 mt-1" style="color: #0ea5e9;"></i>
                            <div>
                                <h6 class="fw-bold mb-1 admin-message-title">Special Instruction</h6>
                                <p class="mb-0 admin-message-text">{{ $volunteer->volunteer_notice }}</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted border rounded admin-empty-box">
                            <i class="fas fa-envelope-open-text fa-2x mb-2" style="color: #9ca3af;"></i>
                            <p class="mb-0 fw-medium">No new messages from admin at the moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-header">
                <i class="fas fa-box"></i>
                <h5>Task for Volunteer - Kit Distribution</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Team Name</th>
                                    <th>Institute</th>
                                    <th>Coach Name</th>
                                    <th>Kit Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $team->team_name }}</td>
                                        <td>{{ $team->institute_name }}</td>
                                        <td>{{ $team->coach_name }}</td>
                                        <td>
                                            <form class="kit-form" action="{{ route('volunteer.kit.save') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="team_id" value="{{ $team->team_id }}">

                                                <select name="kit_received"
                                                    class="form-select form-select-sm kit-status-select"
                                                    style="max-width:150px; cursor: pointer;"
                                                    data-original="{{ $team->kit_received ?? 0 }}"
                                                    {{ (($team->kit_received ?? 0) == 1 || $volunteer->status != 1) ? 'disabled' : '' }}>

                                                    <option value="0"
                                                        {{ ($team->kit_received ?? 0) == 0 ? 'selected' : '' }}>Not
                                                        Given</option>
                                                    <option value="1"
                                                        {{ ($team->kit_received ?? 0) == 1 ? 'selected' : '' }}>Given
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    @if($volunteer->status == 1)
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Update the kit status for each team. Click "Save Changes" to save your updates.
                        </small>
                    </div>
                    <div class="mt-3 kit-action-buttons-wrap d-flex flex-column-reverse flex-sm-row gap-2 justify-content-end">
                        <button id="cancelKitBtn" class="btn btn-secondary" onclick="cancelKitChanges()" disabled>
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button id="saveKitBtn" class="btn btn-primary" onclick="saveKitChanges()" disabled>
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                    @else
                    <div class="mt-3">
                        <small class="text-danger fw-medium">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Your Account Is Currently Inactive. Please Contact The Administrator To Activate Your Account & Make Changes.
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- Toast Container (Top-Right Corner) -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="volunteerToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="volunteerToastMessage">
                    <!-- Message goes here -->
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close" id="volunteerToastClose"></button>
            </div>
        </div>
    </div>

    <script>
        function showToast(message, type = 'success') {
            const toastEl = document.getElementById('volunteerToast');
            const toastMessage = document.getElementById('volunteerToastMessage');
            
            // Remove previous type classes
            toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
            
            let iconClass = 'fa-check-circle me-2 text-success';
            if (type === 'success') {
                toastEl.classList.add('bg-success');
                iconClass = 'fa-check-circle me-2';
            } else if (type === 'error') {
                toastEl.classList.add('bg-danger');
                iconClass = 'fa-exclamation-circle me-2';
            } else if (type === 'warning') {
                toastEl.classList.add('bg-warning');
                iconClass = 'fa-exclamation-triangle me-2';
            }
            
            toastMessage.innerHTML = `<i class="fas ${iconClass}"></i> ${message}`;
            const toast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 3500 });
            toast.show();
        }

        // Backward compatibility
        function showWebsiteToast(message, type = 'success') {
            showToast(message, type);
        }

        // Industry Standard Dirty-State Tracking for Action Buttons
        function updateKitActionButtons() {
            const selects = document.querySelectorAll('.kit-status-select');
            let hasChanges = false;
            selects.forEach(select => {
                if (!select.disabled && select.value !== select.getAttribute('data-original')) {
                    hasChanges = true;
                }
            });

            const saveBtn = document.getElementById('saveKitBtn');
            const cancelBtn = document.getElementById('cancelKitBtn');
            if (saveBtn) saveBtn.disabled = !hasChanges;
            if (cancelBtn) cancelBtn.disabled = !hasChanges;
        }

        // Attach change event listeners to all active selects
        document.addEventListener('DOMContentLoaded', function () {
            const selects = document.querySelectorAll('.kit-status-select');
            selects.forEach(select => {
                select.addEventListener('change', updateKitActionButtons);
            });
            updateKitActionButtons();
        });

        function cancelKitChanges() {
            const selects = document.querySelectorAll('.kit-status-select');
            selects.forEach(select => {
                if (!select.disabled) {
                    select.value = select.getAttribute('data-original');
                }
            });
            updateKitActionButtons();
        }

        function saveKitChanges() {
            const forms = document.querySelectorAll('.kit-form');
            const changedForms = [];
            const promises = [];

            forms.forEach(form => {
                const select = form.querySelector('.kit-status-select');
                if (!select.disabled && select.value !== select.getAttribute('data-original')) {
                    changedForms.push({ form, select, newValue: select.value });
                    const formData = new FormData(form);
                    const urlEncodedData = new URLSearchParams(formData).toString();

                    promises.push(
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': formData.get('_token')
                            },
                            body: urlEncodedData
                        }).then(async res => {
                            const data = await res.json().catch(() => null);
                            if (!res.ok) {
                                throw new Error((data && data.message) ? data.message : `HTTP error ${res.status}`);
                            }
                            return data || { success: true };
                        })
                    );
                }
            });

            if (promises.length === 0) {
                showWebsiteToast('No changes to save.', 'warning', 3000);
                return;
            }

            const saveBtn = document.getElementById('saveKitBtn');
            const cancelBtn = document.getElementById('cancelKitBtn');
            const originalBtnHtml = saveBtn ? saveBtn.innerHTML : '';
            if (saveBtn) {
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            }
            if (cancelBtn) {
                cancelBtn.disabled = true;
            }

            Promise.all(promises)
                .then(results => {
                    const failed = results.filter(r => !r || !r.success);
                    if (failed.length === 0) {
                        changedForms.forEach(item => {
                            item.select.setAttribute('data-original', item.newValue);
                            if (item.newValue === '1') {
                                item.select.disabled = true;
                            }
                        });
                        showWebsiteToast('Kit statuses saved successfully!', 'success', 4000);
                    } else {
                        const errMsg = failed[0] && failed[0].message ? failed[0].message : 'Some records failed to save. Please try again.';
                        showWebsiteToast(errMsg, 'error', 5000);
                    }
                })
                .catch(err => {
                    console.error('Kit Save Error:', err);
                    const msg = (err && err.message) ? `Server error: ${err.message}` : 'Server error while saving kit statuses.';
                    showWebsiteToast(msg, 'error', 5000);
                })
                .finally(() => {
                    if (saveBtn) {
                        saveBtn.innerHTML = originalBtnHtml;
                    }
                    updateKitActionButtons();
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('content/website') }}/js/dark-mode.js"></script>

</body>

</html>
