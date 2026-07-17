<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - {{ $setting->website_name ?? 'Your Website Name' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('content/website/image/favicon.ico') }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/volunteer_dashboard.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/dark-mode.css">
</head>

<body>

    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-3">
                <div>
                    <h1><i class="fas fa-hands-helping me-2"></i>Volunteer Dashboard</h1>
                    <p class="subtitle mb-0">
                        {{ ($contest && $contest->status == 1 && !empty($contest->title)) ? $contest->title : 'Your Contest Title' }}
                    </p>
                </div>
                <div class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2 mt-2 mt-md-0 w-100 w-md-auto">
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
                        @if($volunteer->status == 1)
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Update the kit status for each team. Click "Save Changes" to save your updates.
                            </small>
                        </div>
                        <div class="mt-3 d-flex gap-2 justify-content-end">
                            <button class="btn btn-secondary" onclick="cancelKitChanges()">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button class="btn btn-primary" onclick="saveKitChanges()">
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

    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
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
            const closeBtn = document.getElementById('volunteerToastClose');
            
            // Remove previous classes
            toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'text-white', 'text-dark');
            closeBtn.classList.remove('btn-close-white');
            
            if(type === 'success') {
                toastEl.classList.add('bg-success', 'text-white');
                closeBtn.classList.add('btn-close-white');
            } else if(type === 'error') {
                toastEl.classList.add('bg-danger', 'text-white');
                closeBtn.classList.add('btn-close-white');
            } else if(type === 'warning') {
                toastEl.classList.add('bg-warning', 'text-dark');
            }
            
            toastMessage.textContent = message;
            const toast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay: 3000 });
            toast.show();
        }

        function cancelKitChanges() {
            const selects = document.querySelectorAll('.kit-status-select');
            selects.forEach(select => {
                if (!select.disabled) {
                    select.value = select.getAttribute('data-original');
                }
            });
        }

        function saveKitChanges() {
            const forms = document.querySelectorAll('.kit-form');
            let promises = [];

            forms.forEach(form => {
                const select = form.querySelector('.kit-status-select');
                if (!select.disabled && select.value !== select.getAttribute('data-original')) {
                    const formData = new FormData(form);

                    promises.push(
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': formData.get('_token')
                            },
                            body: formData
                        }).then(res => res.json())
                    );
                }
            });

            if (promises.length === 0) {
                return;
            }

            Promise.all(promises)
                .then(results => {
                    let failed = results.filter(r => !r.success);
                    if (failed.length === 0) {
                        sessionStorage.setItem('kitSavedSuccess', 'true');
                        location.reload();
                    } else {
                        let messages = failed.map(r => r.message).filter(m => m).join('\n');
                        console.error(failed);
                        showToast('Some records failed to save!', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    showToast('Server error while saving kit statuses.', 'error');
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (sessionStorage.getItem('kitSavedSuccess')) {
                showToast('Kit statuses saved successfully!', 'success');
                sessionStorage.removeItem('kitSavedSuccess');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('content/website') }}/js/dark-mode.js"></script>

</body>

</html>
