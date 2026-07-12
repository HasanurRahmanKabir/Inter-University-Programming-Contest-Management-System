   @extends('admin.layout.admin')
   @section('content')
       <link rel="stylesheet" href="{{ asset('content/admin') }}/css/rulesregulations_admin.css">

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

               <!-- Form Section -->
               <div class="form-section">
                   <div class="mb-4">
                       <div>
                           <h4 class="fw-bold mb-0 text-dark">Add Rules & Regulations</h4>
                           <p class="text-muted small mb-0">Create and manage rules with multiple points</p>
                       </div>
                   </div>

                   <form action="{{ url('/admin/dashboard/rules_admin/store') }}" method="post">
                       @csrf
                       <div class="mb-3">
                           <label for="ruleHeadline" class="form-label fw-bold">Rules Headline</label>
                           <input type="text" id="ruleHeadline" class="form-control" name="rules_headline"
                               placeholder="e.g., General Rules, Team Requirements, Scoring Rules" required>
                       </div>

                       <div class="mb-3">
                           <label for="ruleLines" class="form-label fw-bold">Rules Description (One per line)</label>
                           <textarea id="ruleLines" class="form-control" name="rules_description" rows="6"
                               placeholder="Enter each rule on a new line&#10;Example:&#10;- All team members must arrive 15 minutes before the contest&#10;- Cheating will result in disqualification&#10;- Mobile phones are not allowed during the contest"
                               required></textarea>
                           <small class="text-muted">Enter each rule on a separate line. Prepend with '- ' for automatic
                               formatting.</small>
                       </div>

                       <div class="d-flex flex-column flex-sm-row gap-2">
                           <button type="submit" class="btn btn-primary px-4"><i class="fas fa-plus me-2"></i>Add
                               Rule</button>
                           <button type="reset" class="btn btn-light px-4"><i class="fas fa-times me-2"></i>Clear</button>
                       </div>
                   </form>
               </div>

               <!-- Rules Display Section -->
               <div class="rules-display">
                   <div class="mb-4">
                       <div>
                           <h4 class="fw-bold mb-0 text-dark">Published Rules & Regulations</h4>
                           <p class="text-muted small mb-0">Manage and publish rules to the public</p>
                       </div>
                   </div>

                   <div id="rulesContainer">
                       @if ($rules->count() > 0)
                           @foreach ($rules as $rule)
                               <div class="card mb-3">
                                   <div class="card-body">

                                       <!-- Headline + Publish Badge -->
                                       <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-2 mb-3">
                                           <h5 class="card-title mb-0 text-break">{{ $rule->rules_headline }}</h5>

                                           @if ($rule->is_published)
                                               <span class="badge bg-success align-self-start">Published</span>
                                           @else
                                               <span class="badge bg-secondary align-self-start">Draft</span>
                                           @endif
                                       </div>

                                       <!-- Rule Description -->
                                       <ul class="card-text text-muted mb-3 ps-3">
                                           @foreach (explode("\n", $rule->rules_description) as $line)
                                               @if(trim($line) !== '')
                                                   <li>{{ ltrim(trim($line), '- ') }}</li>
                                               @endif
                                           @endforeach
                                       </ul>

                                       <!-- Action Buttons -->
                                       <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-3">

                                           <!-- Edit Button -->
                                           <button type="button" class="btn btn-light btn-sm text-primary d-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0"
                                               style="height:38px; font-size:0.875rem; padding:0 12px;"
                                               data-bs-toggle="modal" data-bs-target="#editRuleModal{{ $rule->rules_id }}">
                                               <i class="fas fa-edit me-1"></i> Edit
                                           </button>

                                           <button type="button" class="btn btn-light btn-sm text-danger d-flex align-items-center justify-content-center flex-grow-1 flex-sm-grow-0"
                                               style="height:38px; font-size:0.875rem; padding:0 12px;"
                                               data-bs-toggle="modal" data-bs-target="#deleteRuleModal{{ $rule->rules_id }}">
                                               <i class="fas fa-trash me-1"></i> Delete
                                           </button>

                                       </div>

                                       <!-- Edit Modal -->
                                       <div class="modal fade" id="editRuleModal{{ $rule->rules_id }}" tabindex="-1"
                                           aria-hidden="true">
                                           <div class="modal-dialog modal-lg">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title fw-bold">Edit Rules & Regulations</h5>
                                                       <button type="button" class="btn-close"
                                                           data-bs-dismiss="modal"></button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <form action="{{ route('admin.rules.update', $rule->rules_id) }}"
                                                           method="post">
                                                           @csrf
                                                           @method('put')

                                                           <div class="mb-3">
                                                               <label for="editRuleHeadline{{ $rule->rules_id }}"
                                                                   class="form-label text-muted small fw-bold">
                                                                   Edit Rules Headline
                                                               </label>
                                                               <input type="text"
                                                                   id="editRuleHeadline{{ $rule->rules_id }}"
                                                                   name="rules_headline" class="form-control"
                                                                   value="{{ $rule->rules_headline }}" required>
                                                           </div>

                                                           <div class="mb-3">
                                                               <label for="editRuleDescription{{ $rule->rules_id }}"
                                                                   class="form-label text-muted small fw-bold">
                                                                   Edit Rules Description
                                                               </label>
                                                               <textarea id="editRuleDescription{{ $rule->rules_id }}" name="rules_description" class="form-control"
                                                                   rows="5" required>{{ $rule->rules_description }}</textarea>
                                                           </div>

                                                           <div class="mb-3">
                                                               <label
                                                                   class="form-label text-muted small fw-bold">Status</label>
                                                               <select name="is_published" class="form-select" required>
                                                                   <option value="1"
                                                                       {{ $rule->is_published ? 'selected' : '' }}>Active
                                                                       (Visible to users)
                                                                   </option>
                                                                   <option value="0"
                                                                       {{ !$rule->is_published ? 'selected' : '' }}>
                                                                       Inactive (Hidden)</option>
                                                               </select>
                                                           </div>

                                                           <div class="modal-footer d-flex flex-wrap gap-2">
                                                               <button type="button" class="btn btn-light"
                                                                   data-bs-dismiss="modal">Discard</button>
                                                               <button type="submit" class="btn btn-primary px-4">Update
                                                                   Rule</button>
                                                           </div>
                                                       </form>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <!-- End Edit Modal -->

                                       <!-- Delete Modal -->
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
                                                       <p class="text-muted mb-4">Are you sure you want to delete the rule <strong>"{{ $rule->rules_headline }}"</strong>? This action cannot be undone.</p>
                                                       
                                                       <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                           <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                           <form action="{{ url('/admin/dashboard/rules_admin/delete/' . $rule->rules_id) }}" method="post" class="m-0">
                                                               @csrf
                                                               @method('delete')
                                                               <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
                                                           </form>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <!-- End Delete Modal -->

                                   </div>
                               </div>
                           @endforeach
                       @else
                           <div class="text-center text-muted py-5">
                               <i class="fas fa-inbox fs-1 mb-3"></i>
                               <p>No rules added yet.</p>
                           </div>
                       @endif
                   </div>


               </div>
           </div>


           <script>
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
                           alert('Profile updated successfully!');
                           const profileModal = bootstrap.Modal.getInstance(
                               document.getElementById('profileModal')
                           );
                           profileModal?.hide();
                       } else {
                           alert('Please fill in all required fields.');
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
                           alert('Please fill in all password fields!');
                           return;
                       }

                       if (newPassword !== confirmPassword) {
                           alert('Passwords do not match!');
                           return;
                       }

                       if (newPassword.length < 6) {
                           alert('Password must be at least 6 characters long!');
                           return;
                       }

                       alert('Password updated successfully!');
                       const settingsModal = bootstrap.Modal.getInstance(
                           document.getElementById('settingsModal')
                       );
                       settingsModal?.hide();

                       document.getElementById('settingsForm')?.reset();
                   });
               }
           </script>
       </div> <!-- Closing main-content -->
@endsection

