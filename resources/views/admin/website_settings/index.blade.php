@extends('admin.layout.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/rulesregulations_admin.css">

    <div class="main-content">
        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Website Settings</h5>

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

        <div class="container-fluid p-3 p-md-4">
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

            <div class="form-section shadow-sm p-3 p-md-4 bg-white rounded">
                <div class="mb-4 pb-2 border-bottom">
                    <h4 class="fw-bold text-dark">Update Website Settings</h4>
                    <p class="text-muted small">Update your website branding, contact info, and social links here.</p>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-images me-2"></i>Branding & Media</h6>
                    <div class="row g-3">
                        @php $images = ['header_logo' => 'Header Logo', 'footer_logo' => 'Footer Logo', 'hero_banner' => 'Hero Banner', 'about_image' => 'About Us Image']; @endphp

                        @foreach($images as $key => $label)
                            <div class="col-12 col-sm-6 col-lg-3">
                                <label class="form-label small fw-bold">{{ $label }}</label>

                                @if(!empty($setting->$key))
                                    <div class="mb-2 position-relative d-inline-block" id="img-container-{{ $key }}">
                                        <img src="{{ asset($setting->$key) }}" alt="{{ $label }}" class="img-thumbnail"
                                            style="height: 80px; width: auto;">

                                        {{-- Image remove button --}}
                                        <button type="button" 
                                            class="btn btn-sm btn-danger rounded-circle position-absolute d-flex align-items-center justify-content-center p-0"
                                            style="width: 24px; height: 24px; top: -8px; right: -8px; z-index: 5;"
                                            onclick="let el = document.getElementById('img-container-{{ $key }}'); el.classList.remove('d-inline-block'); el.classList.add('d-none'); document.getElementById('delete-{{ $key }}').disabled=false;"
                                            title="Remove Image">
                                            <i class="fas fa-times" style="font-size: 12px;"></i>
                                        </button>
                                        <input type="hidden" name="delete_images[]" value="{{ $key }}" id="delete-{{ $key }}" disabled>
                                    </div>
                                @endif

                                <input type="file" name="{{ $key }}" class="form-control shadow-none mb-1">
                                @if($key === 'header_logo' || $key === 'footer_logo')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 3:1 or 4:1 (e.g. 250x80px). Max: 2MB.</small>
                                @elseif($key === 'hero_banner')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 16:9 (e.g. 1920x1080px). Max: 5MB.</small>
                                @elseif($key === 'about_image')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 4:3 or 1:1 (e.g. 800x600px). Max: 3MB.</small>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-pen-nib me-2"></i>Website Content</h6>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label small fw-bold">Website Name</label>
                            <input type="text" name="website_name" class="form-control shadow-none"
                                placeholder="Enter Website Name" value="{{ $setting->website_name ?? '' }}">
                        </div>

                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">Hero Title</label>
                            <input type="text" name="hero_title" class="form-control shadow-none"
                                value="{{ $setting->hero_title ?? '' }}">
                        </div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">About Us Title</label>
                            <input type="text" name="about_title" class="form-control shadow-none"
                                value="{{ $setting->about_title ?? '' }}">
                        </div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">Hero Description</label>
                            <textarea name="hero_description" class="form-control shadow-none"
                                rows="2">{{ $setting->hero_description ?? '' }}</textarea>
                        </div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">About Us Description</label>
                            <textarea name="about_description" class="form-control shadow-none"
                                rows="2">{{ $setting->about_description ?? '' }}</textarea>
                        </div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-calendar-alt me-2"></i>Event Schedule</h6>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="small fw-bold text-dark mb-2">Schedule 1</h6>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Title</label>
                                    <input type="text" name="event_schedule_title_1" class="form-control shadow-none"
                                        value="{{ $setting->event_schedule_title_1 ?? '' }}">
                                </div>
                                <div>
                                    <label class="form-label small text-muted">Description</label>
                                    <textarea name="event_schedule_description_1" class="form-control shadow-none"
                                        rows="2">{{ $setting->event_schedule_description_1 ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="small fw-bold text-dark mb-2">Schedule 2</h6>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Title</label>
                                    <input type="text" name="event_schedule_title_2" class="form-control shadow-none"
                                        value="{{ $setting->event_schedule_title_2 ?? '' }}">
                                </div>
                                <div>
                                    <label class="form-label small text-muted">Description</label>
                                    <textarea name="event_schedule_description_2" class="form-control shadow-none"
                                        rows="2">{{ $setting->event_schedule_description_2 ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-address-card me-2"></i>Contact Details
                    </h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-3"><label class="form-label small fw-bold">Prize Pool
                                Amount</label><input type="text" name="prize_pool_amount" class="form-control shadow-none"
                                value="{{ $setting->prize_pool_amount ?? '' }}"></div>
                        <div class="col-12 col-md-6 col-lg-3"><label class="form-label small fw-bold">Email
                                Address</label><input type="email" name="email" class="form-control shadow-none"
                                value="{{ $setting->email ?? '' }}"></div>
                        <div class="col-12 col-md-6 col-lg-3"><label class="form-label small fw-bold">Phone
                                Number</label><input type="text" name="phone_number" class="form-control shadow-none"
                                value="{{ $setting->phone_number ?? '' }}"></div>
                        <div class="col-12 col-md-6 col-lg-3"><label class="form-label small fw-bold">Location</label><input
                                type="text" name="location" class="form-control shadow-none"
                                value="{{ $setting->location ?? '' }}"></div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Footer Description</label>
                            <textarea name="footer_description" class="form-control shadow-none mb-2" rows="2"
                                placeholder="Footer Description">{{ $setting->footer_description ?? '' }}</textarea>

                            <label class="form-label small fw-bold">Copyright Text</label>
                            <input type="text" name="copyright_text" class="form-control shadow-none"
                                placeholder="Copyright Text" value="{{ $setting->copyright_text ?? '' }}">
                        </div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-share-alt me-2"></i>Social Profiles</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-4"><label class="form-label small fw-bold">Facebook URL</label><input
                                type="text" name="facebook_link" class="form-control shadow-none"
                                value="{{ $setting->facebook_link ?? '' }}"></div>
                        <div class="col-12 col-md-4"><label class="form-label small fw-bold">Youtube URL</label><input
                                type="text" name="youtube_link" class="form-control shadow-none"
                                value="{{ $setting->youtube_link ?? '' }}"></div>
                        <div class="col-12 col-md-4"><label class="form-label small fw-bold">Linkedin URL</label><input
                                type="text" name="linkedin_link" class="form-control shadow-none"
                                value="{{ $setting->linkedin_link ?? '' }}"></div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-globe me-2"></i>External Platforms</h6>
                    <div class="row g-3">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="col-12 col-lg-6">
                                <div class="p-3 border rounded bg-light">
                                    <h6 class="small fw-bold text-dark mb-2">Platform {{$i}}</h6>
                                    <div class="row g-2">
                                        <div class="col-12 col-sm-6">
                                            <label class="form-label small text-muted text-break">Platform Name</label>
                                            <input type="text" name="platform_{{$i}}_name" class="form-control shadow-none"
                                                placeholder="e.g. Steam"
                                                value="{{ $setting->{'platform_' . $i . '_name'} ?? '' }}">
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label class="form-label small text-muted text-break">Platform Link</label>
                                            <input type="text" name="platform_{{$i}}_link" class="form-control shadow-none"
                                                placeholder="https://..."
                                                value="{{ $setting->{'platform_' . $i . '_link'} ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm flex-grow-1 flex-sm-grow-0"><i class="fas fa-save me-2"></i>Save
                            Changes</button>
                        <button type="reset" class="btn btn-outline-secondary px-4 flex-grow-1 flex-sm-grow-0">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            //Sidebar Logic
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggleBtn = document.getElementById('sidebarToggle');

            function toggleSidebar() {
                if(sidebar && overlay) {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                }
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
    </div>
@endsection
