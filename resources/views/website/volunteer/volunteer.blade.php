<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard - SUBIUPC</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/volunteer_dashboard.css">
</head>

<body>

    <div class="dashboard-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-hands-helping me-2"></i>Volunteer Dashboard</h1>
                    <p class="subtitle mb-0">
                        {{ $contest->title ?? 'SUBIUPC 2025' }}
                    </p>
                </div>
                <div>
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
                    <i class="fas fa-id-badge fa-2x" style="color: #7c3aed;"></i>
                    <h3>#{{ $volunteer->volunteer_id }}</h3>
                    <p>Volunteer ID</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card" style="border-left-color: #10b981;">
                    <i class="fas fa-check-circle fa-2x text-success"></i>
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
                <div class="col-md-6">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ $volunteer->name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $volunteer->email }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ $volunteer->phone }}</div>
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
                                                    {{ ($team->kit_received ?? 0) == 1 ? 'disabled' : '' }}>

                                                    <option value="0"
                                                        {{ ($team->kit_received ?? 0) == 0 ? 'selected' : '' }}>Not
                                                        Given</option>
                                                    <option value="1"
                                                        {{ ($team->kit_received ?? 0) == 1 ? 'selected' : '' }}>Given
                                                    </option>
                                                </select>
                                            </form>
                                @endforeach

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const selects = document.querySelectorAll('.kit-status-select');

                                        selects.forEach(select => {
                                            select.addEventListener('change', function() {
                                                const form = this.closest('form');
                                                const formData = new FormData(form);
                                                const originalColor = this.style.backgroundColor;
                                                const selectedValue = this.value;
                                                let isFinalized = false;


                                                this.style.backgroundColor = '#e9ecef';
                                                this.disabled = true;

                                                fetch(form.action, {
                                                        method: 'POST',
                                                        body: formData,
                                                        headers: {
                                                            'X-Requested-With': 'XMLHttpRequest'
                                                        }
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.success) {
                                                            this.style.border = '2px solid green';

                                                            if (selectedValue == '1') {
                                                                isFinalized = true;
                                                            } else {

                                                                setTimeout(() => {
                                                                    this.style.border = '';
                                                                }, 2000);
                                                            }
                                                        } else {
                                                            alert('Error saving status: ' + data.message);
                                                            this.style.border = '2px solid red';
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                        alert('Something went wrong!');
                                                    })
                                                    .finally(() => {
                                                        if (!isFinalized) {
                                                            this.style.backgroundColor = originalColor;
                                                            this.disabled = false;
                                                        } else {

                                                            this.style.backgroundColor = '#e9ecef';
                                                            this.disabled = true;
                                                        }
                                                    });
                                            });
                                        });
                                    });
                                </script>
                            </tbody>

                        </table>
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
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        function saveKitChanges() {
            const forms = document.querySelectorAll('.kit-form');
            let promises = [];

            forms.forEach(form => {
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
            });

            Promise.all(promises)
                .then(results => {
                    let failed = results.filter(r => !r.success);
                    if (failed.length === 0) {
                        alert('All kit statuses saved successfully!');
                        location.reload();
                    } else {
                        let messages = failed.map(r => r.message).filter(m => m).join('\n');
                        console.error(failed);
                        alert('Some records failed to save!\n' + messages);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Server error while saving kit statuses.');
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
