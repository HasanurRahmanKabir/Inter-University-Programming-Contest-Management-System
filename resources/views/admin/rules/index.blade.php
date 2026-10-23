@extends('admin.layout.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/notices.css">

    <div class="main-content">
        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Rules & Regulations</h5>

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

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong class="mb-0">Please fix the following errors:</strong>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header Action with Add Button matching Contests/Notices/Volunteers -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center align-items-start gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-1 text-dark">Rules & Regulations</h4>
                    <p class="text-muted small mb-0">Create and manage contest rules and guidelines</p>
                </div>
                <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#addRuleModal">
                    <i class="fas fa-plus me-2"></i> Add New Rule
                </button>
            </div>

            <!-- Rules Table matching Notices, Contests and Volunteers -->
            <div class="custom-table-card p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">#</th>
                                <th>Headline</th>
                                <th>Rule Points / Details</th>
                                <th>Status</th>
                                <th class="text-end" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rules as $index => $rule)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-muted">{{ $index + 1 }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $rule->rules_headline }}</div>
                                    </td>
                                    <td>
                                        <div class="text-muted small">
                                            @foreach (explode("\n", $rule->rules_description) as $line)
                                                @if(trim($line) !== '')
                                                    <div class="d-flex align-items-start mb-1">
                                                        <i class="fas fa-check-circle text-primary me-2 mt-1" style="font-size: 0.75rem;"></i>
                                                        <span>{{ ltrim(trim($line), '- ') }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $rule->is_published ? 'bg-success text-white' : 'bg-secondary text-white' }} rounded-pill px-3">
                                            {{ $rule->is_published ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="text-end text-nowrap">
                                        <button type="button" class="btn btn-light btn-sm text-primary"
                                            data-bs-toggle="modal" data-bs-target="#editRuleModal{{ $rule->rules_id }}"
                                            title="Edit"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-light btn-sm text-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteRuleModal{{ $rule->rules_id }}"
                                            title="Remove"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- Edit Rule Modal -->
                                <div class="modal fade" id="editRuleModal{{ $rule->rules_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Edit Rules & Regulations</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <form action="{{ route('admin.rules.update', $rule->rules_id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="modal_id" value="editRuleModal{{ $rule->rules_id }}">
                                                    
                                                    @if ($errors->any() && old('modal_id') == 'editRuleModal' . $rule->rules_id)
                                                        <div class="alert alert-danger small shadow-sm">
                                                            <ul class="mb-0 ps-3">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <div class="mb-3">
                                                        <label for="editRuleHeadline{{ $rule->rules_id }}"
                                                            class="form-label text-muted small fw-bold">
                                                            Rules Headline
                                                        </label>
                                                        <input type="text"
                                                            id="editRuleHeadline{{ $rule->rules_id }}"
                                                            name="rules_headline" class="form-control"
                                                            value="{{ $rule->rules_headline }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="editRuleDescription{{ $rule->rules_id }}"
                                                            class="form-label text-muted small fw-bold">
                                                            Rules Description (One per line)
                                                        </label>
                                                        <textarea id="editRuleDescription{{ $rule->rules_id }}" name="rules_description" class="form-control"
                                                            rows="5" required>{{ $rule->rules_description }}</textarea>
                                                        <small class="text-muted" style="font-size: 0.78rem;">Enter each rule point on a separate line.</small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label text-muted small fw-bold">Status</label>
                                                        <select name="is_published" class="form-select" required>
                                                            <option value="1" {{ $rule->is_published ? 'selected' : '' }}>Published (Visible to users)</option>
                                                            <option value="0" {{ !$rule->is_published ? 'selected' : '' }}>Draft (Hidden)</option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary px-4">Update Rule</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Edit Rule Modal -->

                                <!-- Delete Rule Modal -->
                                <div class="modal fade" id="deleteRuleModal{{ $rule->rules_id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center pb-4">
                                                <div class="text-danger mb-3">
                                                    <i class="fas fa-exclamation-circle fa-4x opacity-75"></i>
                                                </div>
                                                <h5 class="fw-bold text-dark mb-2">Delete Rule?</h5>
                                                <p class="text-muted mb-4">Are you sure you want to delete <strong>"{{ $rule->rules_headline }}"</strong>? This action cannot be undone.</p>
                                                
                                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.rules.destroy', $rule->rules_id) }}" method="post" class="m-0">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Rule Modal -->
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="fas fa-gavel mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                                        <h5 class="fw-bold mb-1 text-dark">No rules added yet</h5>
                                        <p class="mb-0 small text-muted">There are no published rules or regulations for this contest yet.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Rule Modal -->
    <div class="modal fade" id="addRuleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Rules & Regulations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.rules.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="modal_id" value="addRuleModal">
                        
                        @if ($errors->any() && old('modal_id') == 'addRuleModal')
                            <div class="alert alert-danger small shadow-sm">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="ruleHeadline" class="form-label text-muted small fw-bold">Rules Headline</label>
                            <input type="text" id="ruleHeadline" class="form-control" name="rules_headline"
                                placeholder="e.g., General Rules, Team Requirements, Scoring Rules" value="{{ old('rules_headline') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ruleLines" class="form-label text-muted small fw-bold">Rules Description (One per line)</label>
                            <textarea id="ruleLines" class="form-control" name="rules_description" rows="6"
                                placeholder="Enter each rule on a new line&#10;Example:&#10;- All team members must arrive 15 minutes before the contest&#10;- Cheating will result in disqualification&#10;- Mobile phones are not allowed during the contest"
                                required>{{ old('rules_description') }}</textarea>
                            <small class="text-muted" style="font-size: 0.78rem;">Enter each rule on a separate line. Prepend with '- ' for automatic formatting.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Status</label>
                            <select name="is_published" class="form-select" required>
                                <option value="1" {{ old('is_published', '1') == '1' ? 'selected' : '' }}>Published (Visible to users)</option>
                                <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Draft (Hidden)</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Add Rule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Alert Modal -->
    <div class="modal fade" id="customAlertModal" tabindex="-1" aria-labelledby="customAlertModalLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h6 class="modal-title fw-bold" id="customAlertModalLabel">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i><span id="customAlertTitle">Alert</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3 pb-3 text-center">
                    <p id="customAlertMessage" class="mb-0 text-muted" style="font-size: 14px;">Message goes here.</p>
                </div>
                <div class="modal-footer border-top-0 pt-0 justify-content-center pb-3">
                    <button type="button" class="btn btn-primary rounded-pill px-4 btn-sm" data-bs-dismiss="modal">OK, Got it</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCustomAlert(title, message) {
            document.getElementById('customAlertTitle').innerText = title;
            document.getElementById('customAlertMessage').innerText = message;
            var alertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
            alertModal.show();
        }

        //Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', toggleSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        //Profile Settings
        const saveProfileBtn = document.getElementById('saveProfileBtn');

        if (saveProfileBtn) {
            saveProfileBtn.addEventListener('click', () => {
                const firstName = document.getElementById('adminFirstName')?.value.trim();
                const lastName = document.getElementById('adminLastName')?.value.trim();
                const email = document.getElementById('adminEmail')?.value.trim();

                if (firstName && lastName && email) {
                    showCustomAlert('Success', 'Profile updated successfully!');
                    const profileModal = bootstrap.Modal.getInstance(
                        document.getElementById('profileModal')
                    );
                    profileModal?.hide();
                } else {
                    showCustomAlert('Warning', 'Please fill in all required fields.');
                }
            });
        }

        //Password Settings
        const saveSettingsBtn = document.getElementById('saveSettingsBtn');

        if (saveSettingsBtn) {
            saveSettingsBtn.addEventListener('click', () => {
                const currentPassword = document.getElementById('currentPassword')?.value.trim();
                const newPassword = document.getElementById('newPassword')?.value.trim();
                const confirmPassword = document.getElementById('confirmPassword')?.value.trim();

                if (!currentPassword || !newPassword || !confirmPassword) {
                    showCustomAlert('Warning', 'Please fill in all password fields!');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    showCustomAlert('Error', 'Passwords do not match!');
                    return;
                }

                if (newPassword.length < 6) {
                    showCustomAlert('Warning', 'Password must be at least 6 characters long!');
                    return;
                }

                showCustomAlert('Success', 'Password updated successfully!');
                const settingsModal = bootstrap.Modal.getInstance(
                    document.getElementById('settingsModal')
                );
                settingsModal?.hide();

                document.getElementById('settingsForm')?.reset();
            });
        }
    </script>
@endsection
