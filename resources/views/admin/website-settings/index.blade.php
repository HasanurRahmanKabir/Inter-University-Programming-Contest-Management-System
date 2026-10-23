@extends('admin.layout.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/rules.css">

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

            @if ($errors->any() && !old('modal_id'))
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
                        @php $images = ['website_favicon' => 'Website Favicon', 'admin_favicon' => 'Admin Favicon', 'coach_favicon' => 'Coach Favicon', 'volunteer_favicon' => 'Volunteer Favicon', 'header_logo' => 'Header Logo', 'footer_logo' => 'Footer Logo', 'hero_banner' => 'Hero Banner', 'about_image' => 'About Us Image']; @endphp

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

                                <input type="file" name="{{ $key }}" class="form-control shadow-none mb-1 media-file-input @error($key) is-invalid @enderror"
                                    accept="{{ in_array($key, ['website_favicon', 'admin_favicon', 'coach_favicon', 'volunteer_favicon']) ? '.ico,.png,.jpg,.jpeg,.webp,.svg,image/x-icon,image/png,image/jpeg,image/webp,image/svg+xml' : 'image/png,image/jpeg,image/webp,image/svg+xml,.png,.jpg,.jpeg,.webp,.svg' }}">
                                @error($key)
                                    <div class="invalid-feedback d-block mb-1">{{ $message }}</div>
                                @enderror
                                @if($key === 'website_favicon' || $key === 'admin_favicon' || $key === 'coach_favicon' || $key === 'volunteer_favicon')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 1:1 (e.g. 32x32px or 512x512px). Formats: ICO, PNG, JPG, WEBP, SVG. Max: 1MB.</small>
                                @elseif($key === 'header_logo' || $key === 'footer_logo')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 3:1 or 4:1 (e.g. 250x80px). Formats: PNG, JPG, WEBP, SVG. Max: 2MB.</small>
                                @elseif($key === 'hero_banner')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 16:9 (e.g. 1920x1080px). Formats: PNG, JPG, WEBP. Max: 5MB.</small>
                                @elseif($key === 'about_image')
                                    <small class="text-muted d-block" style="font-size: 0.75rem;"><i class="fas fa-info-circle me-1 text-primary"></i>Ratio: 4:3 or 1:1 (e.g. 800x600px). Formats: PNG, JPG, WEBP. Max: 3MB.</small>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-pen-nib me-2"></i>Website Content</h6>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <label class="form-label small fw-bold">Website Name</label>
                            <input type="text" name="website_name" class="form-control shadow-none @error('website_name') is-invalid @enderror"
                                placeholder="Enter Website Name" value="{{ old('website_name', $setting->website_name ?? '') }}">
                            @error('website_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">Hero Title</label>
                            <input type="text" name="hero_title" class="form-control shadow-none @error('hero_title') is-invalid @enderror"
                                value="{{ old('hero_title', $setting->hero_title ?? '') }}">
                            @error('hero_title') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">About Us Title</label>
                            <input type="text" name="about_title" class="form-control shadow-none @error('about_title') is-invalid @enderror"
                                value="{{ old('about_title', $setting->about_title ?? '') }}">
                            @error('about_title') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">Hero Description</label>
                            <textarea name="hero_description" class="form-control shadow-none @error('hero_description') is-invalid @enderror"
                                rows="2">{{ old('hero_description', $setting->hero_description ?? '') }}</textarea>
                            @error('hero_description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">About Us Description</label>
                            <textarea name="about_description" class="form-control shadow-none @error('about_description') is-invalid @enderror"
                                rows="2">{{ old('about_description', $setting->about_description ?? '') }}</textarea>
                            @error('about_description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-calendar-alt me-2"></i>Event Schedule</h6>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="small fw-bold text-dark mb-2">Schedule 1</h6>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Title</label>
                                    <input type="text" name="event_schedule_title_1" class="form-control shadow-none @error('event_schedule_title_1') is-invalid @enderror"
                                        value="{{ old('event_schedule_title_1', $setting->event_schedule_title_1 ?? '') }}">
                                    @error('event_schedule_title_1') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label class="form-label small text-muted">Description</label>
                                    <textarea name="event_schedule_description_1" class="form-control shadow-none @error('event_schedule_description_1') is-invalid @enderror"
                                        rows="2">{{ old('event_schedule_description_1', $setting->event_schedule_description_1 ?? '') }}</textarea>
                                    @error('event_schedule_description_1') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="p-3 border rounded bg-light">
                                <h6 class="small fw-bold text-dark mb-2">Schedule 2</h6>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Title</label>
                                    <input type="text" name="event_schedule_title_2" class="form-control shadow-none @error('event_schedule_title_2') is-invalid @enderror"
                                        value="{{ old('event_schedule_title_2', $setting->event_schedule_title_2 ?? '') }}">
                                    @error('event_schedule_title_2') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label class="form-label small text-muted">Description</label>
                                    <textarea name="event_schedule_description_2" class="form-control shadow-none @error('event_schedule_description_2') is-invalid @enderror"
                                        rows="2">{{ old('event_schedule_description_2', $setting->event_schedule_description_2 ?? '') }}</textarea>
                                    @error('event_schedule_description_2') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-address-card me-2"></i>Contact Details
                    </h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-3">
                            <label class="form-label small fw-bold">Prize Pool Amount</label>
                            <input type="text" name="prize_pool_amount" class="form-control shadow-none @error('prize_pool_amount') is-invalid @enderror"
                                placeholder="e.g. 50,000 BDT"
                                value="{{ old('prize_pool_amount', $setting->prize_pool_amount ?? '') }}">
                            @error('prize_pool_amount') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control shadow-none @error('email') is-invalid @enderror"
                                placeholder="info@example.com"
                                value="{{ old('email', $setting->email ?? '') }}">
                            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label class="form-label small fw-bold d-flex justify-content-between align-items-center mb-1">
                                <span>Phone Number</span>
                                <span class="badge bg-light text-secondary border fw-normal py-1 px-2 setting-phone-badge" style="font-size: 0.68rem; letter-spacing: 0.2px;">Digits, +, - only</span>
                            </label>
                            <input type="text" name="phone_number" class="form-control shadow-none setting-phone-input @error('phone_number') is-invalid @enderror"
                                placeholder="+8801XXXXXXXXX"
                                value="{{ old('phone_number', $setting->phone_number ?? '') }}">
                            <div class="setting-phone-alert small text-danger mt-1 d-none" style="font-size: 0.78rem;">
                                <i class="fas fa-exclamation-circle me-1"></i>Letters and symbols are not allowed in phone number!
                            </div>
                            <div class="invalid-feedback client-setting-phone-feedback d-none">Only digits (0-9), +, and - are allowed.</div>
                            @error('phone_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <label class="form-label small fw-bold">Location</label>
                            <input type="text" name="location" class="form-control shadow-none @error('location') is-invalid @enderror"
                                placeholder="City, Country"
                                value="{{ old('location', $setting->location ?? '') }}">
                            @error('location') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Footer Description</label>
                            <textarea name="footer_description" class="form-control shadow-none mb-2 @error('footer_description') is-invalid @enderror" rows="2"
                                placeholder="Footer Description">{{ old('footer_description', $setting->footer_description ?? '') }}</textarea>
                            @error('footer_description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                            <label class="form-label small fw-bold">Copyright Text</label>
                            <input type="text" name="copyright_text" class="form-control shadow-none @error('copyright_text') is-invalid @enderror"
                                placeholder="All Rights Reserved. | Organized by Your Website Name." value="{{ old('copyright_text', $setting->copyright_text ?? '') }}">
                            @error('copyright_text') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-share-alt me-2"></i>Social Profiles</h6>
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label small fw-bold">Facebook URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-primary"><i class="fab fa-facebook-f"></i></span>
                                <input type="url" name="facebook_link" class="form-control shadow-none url-validate-input @error('facebook_link') is-invalid @enderror"
                                    placeholder="https://facebook.com/..."
                                    value="{{ old('facebook_link', $setting->facebook_link ?? '') }}">
                            </div>
                            @error('facebook_link') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label small fw-bold">Youtube URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-danger"><i class="fab fa-youtube"></i></span>
                                <input type="url" name="youtube_link" class="form-control shadow-none url-validate-input @error('youtube_link') is-invalid @enderror"
                                    placeholder="https://youtube.com/..."
                                    value="{{ old('youtube_link', $setting->youtube_link ?? '') }}">
                            </div>
                            @error('youtube_link') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label small fw-bold">Linkedin URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-primary"><i class="fab fa-linkedin-in"></i></span>
                                <input type="url" name="linkedin_link" class="form-control shadow-none url-validate-input @error('linkedin_link') is-invalid @enderror"
                                    placeholder="https://linkedin.com/..."
                                    value="{{ old('linkedin_link', $setting->linkedin_link ?? '') }}">
                            </div>
                            @error('linkedin_link') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
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
                                            <input type="text" name="platform_{{$i}}_name" class="form-control shadow-none @error('platform_'.$i.'_name') is-invalid @enderror"
                                                placeholder="e.g. Codeforces, VJudge"
                                                value="{{ old('platform_' . $i . '_name', $setting->{'platform_' . $i . '_name'} ?? '') }}">
                                            @error('platform_'.$i.'_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label class="form-label small text-muted text-break">Platform Link</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white text-muted"><i class="fas fa-link"></i></span>
                                                <input type="url" name="platform_{{$i}}_link" class="form-control shadow-none url-validate-input @error('platform_'.$i.'_link') is-invalid @enderror"
                                                    placeholder="https://..."
                                                    value="{{ old('platform_' . $i . '_link', $setting->{'platform_' . $i . '_link'} ?? '') }}">
                                            </div>
                                            @error('platform_'.$i.'_link') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center order-2 order-sm-1">
                            <span id="unsavedChangesHint" class="text-muted small d-none"><i class="fas fa-info-circle me-1 text-primary"></i>You have unsaved changes</span>
                        </div>
                        <div class="d-flex flex-column flex-sm-row justify-content-end align-items-stretch align-items-sm-center gap-2 order-1 order-sm-2">
                            <button type="button" id="mainWebsiteSettingsDiscardBtn" class="btn btn-outline-secondary px-4 order-2 order-sm-1" style="display: none;"><i class="fas fa-undo me-1"></i>Discard Changes</button>
                            <button type="submit" id="mainWebsiteSettingsSaveBtn" class="btn btn-primary px-4 shadow-sm order-1 order-sm-2" disabled><i class="fas fa-save me-2"></i>Save Changes</button>
                        </div>
                    </div>
                </form>
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

            function showCustomAlert(title, message) {
                document.getElementById('customAlertTitle').innerText = title;
                document.getElementById('customAlertMessage').innerText = message;
                var alertModal = new bootstrap.Modal(document.getElementById('customAlertModal'));
                alertModal.show();
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

    <style>
        /* Website Settings Phone & Form Visual Feedback */
        @keyframes subtleSettingShake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }
        .setting-phone-shake {
            animation: subtleSettingShake 0.3s ease-in-out;
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
        }
        body[data-theme="dark"] .setting-phone-alert {
            color: #f87171 !important;
        }
        body[data-theme="dark"] label .badge.setting-phone-badge {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Phone Number Input UX Validation (Digits, +, and - only with instant feedback)
            document.querySelectorAll('.setting-phone-input').forEach(function(input) {
                const form = input.closest('form');
                const alertNotice = input.parentElement.querySelector('.setting-phone-alert');
                const clientFeedback = input.parentElement.querySelector('.client-setting-phone-feedback');
                let alertTimeout = null;

                function showInvalidWarning() {
                    if (alertNotice) {
                        alertNotice.classList.remove('d-none');
                    }
                    input.classList.add('setting-phone-shake');
                    clearTimeout(alertTimeout);
                    alertTimeout = setTimeout(function() {
                        input.classList.remove('setting-phone-shake');
                        if (alertNotice) {
                            alertNotice.classList.add('d-none');
                        }
                    }, 2800);
                }

                function sanitizeAndValidate() {
                    const originalVal = input.value;
                    const cleanedVal = originalVal.replace(/[^0-9+\-]/g, '');
                    if (originalVal !== cleanedVal) {
                        input.value = cleanedVal;
                        showInvalidWarning();
                    }

                    const trimmed = input.value.trim();
                    if (trimmed.length > 0) {
                        const isValid = /^[0-9+\-]+$/.test(trimmed);
                        if (!isValid) {
                            input.classList.add('is-invalid');
                            if (clientFeedback) clientFeedback.classList.remove('d-none');
                            input.setCustomValidity('Phone number must contain only digits (0-9), +, and -');
                        } else {
                            input.classList.remove('is-invalid');
                            if (clientFeedback) clientFeedback.classList.add('d-none');
                            input.setCustomValidity('');
                        }
                        return isValid;
                    } else {
                        input.classList.remove('is-invalid');
                        if (clientFeedback) clientFeedback.classList.add('d-none');
                        input.setCustomValidity('');
                        return true;
                    }
                }

                input.addEventListener('input', sanitizeAndValidate);
                input.addEventListener('blur', sanitizeAndValidate);

                input.addEventListener('keypress', function(e) {
                    const char = String.fromCharCode(e.which || e.keyCode);
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
                        const start = input.selectionStart;
                        const end = input.selectionEnd;
                        const currentVal = input.value;
                        const newVal = currentVal.substring(0, start) + filteredData + currentVal.substring(end);
                        input.value = newVal.slice(0, 25);
                        sanitizeAndValidate();
                        showInvalidWarning();
                    }
                });

                if (form) {
                    form.addEventListener('submit', function(e) {
                        const val = input.value.trim();
                        if (val.length > 0 && !/^[0-9+\-]+$/.test(val)) {
                            e.preventDefault();
                            input.classList.add('is-invalid');
                            if (clientFeedback) clientFeedback.classList.remove('d-none');
                            showInvalidWarning();
                            input.focus();
                            return false;
                        }
                    });
                }
            });

            // URL Validation for Social & External Platforms
            document.querySelectorAll('.url-validate-input').forEach(function(urlInput) {
                const form = urlInput.closest('form');

                function validateUrl() {
                    const val = urlInput.value.trim();
                    if (val.length > 0) {
                        // Check if valid URL starting with http:// or https://
                        try {
                            const urlObj = new URL(val);
                            if (urlObj.protocol === 'http:' || urlObj.protocol === 'https:') {
                                urlInput.classList.remove('is-invalid');
                                urlInput.setCustomValidity('');
                                return true;
                            } else {
                                urlInput.classList.add('is-invalid');
                                urlInput.setCustomValidity('URL must begin with http:// or https://');
                                return false;
                            }
                        } catch (err) {
                            urlInput.classList.add('is-invalid');
                            urlInput.setCustomValidity('Please enter a valid URL (e.g. https://example.com)');
                            return false;
                        }
                    } else {
                        urlInput.classList.remove('is-invalid');
                        urlInput.setCustomValidity('');
                        return true;
                    }
                }

                urlInput.addEventListener('input', function() {
                    if (urlInput.classList.contains('is-invalid')) {
                        validateUrl();
                    }
                });

                urlInput.addEventListener('blur', validateUrl);

                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (!validateUrl()) {
                            e.preventDefault();
                            urlInput.focus();
                            return false;
                        }
                    });
                }
            });

            // Instant Client-side File Validation for Media & Images
            const allowedFaviconExts = ['ico', 'png', 'jpg', 'jpeg', 'webp', 'svg'];
            const allowedImageExts = ['png', 'jpg', 'jpeg', 'webp', 'svg'];

            document.querySelectorAll('.media-file-input').forEach(function(fileInput) {
                fileInput.addEventListener('change', function() {
                    if (!this.files || this.files.length === 0) return;
                    const file = this.files[0];
                    const fileName = file.name.toLowerCase();
                    const fileExt = fileName.split('.').pop();
                    const isFavicon = fileInput.name.includes('favicon');
                    const validExts = isFavicon ? allowedFaviconExts : allowedImageExts;

                    if (!validExts.includes(fileExt)) {
                        alert('Invalid file format! Only modern image formats (' + validExts.join(', ').toUpperCase() + ') are allowed.\n\nDocuments (.doc, .pdf, .xls), Executables (.exe, .bat), Archives (.zip), and Videos are strictly prohibited.');
                        this.value = '';
                        this.classList.add('is-invalid');
                        return;
                    }

                    // Check file size limit
                    let maxBytes = 2 * 1024 * 1024; // default 2MB
                    if (isFavicon) maxBytes = 1 * 1024 * 1024; // 1MB
                    else if (fileInput.name === 'hero_banner') maxBytes = 5 * 1024 * 1024; // 5MB
                    else if (fileInput.name === 'about_image') maxBytes = 3 * 1024 * 1024; // 3MB

                    if (file.size > maxBytes) {
                        const maxMB = maxBytes / (1024 * 1024);
                        alert('File is too large! Maximum allowed size for this field is ' + maxMB + 'MB.');
                        this.value = '';
                        this.classList.add('is-invalid');
                        return;
                    }

                    this.classList.remove('is-invalid');
                });
            });

            // Modern Industry-Standard Form Change Detection (Dirty Check)
            const settingsForm = document.querySelector('form[action*="website-settings"]');
            const saveBtn = document.getElementById('mainWebsiteSettingsSaveBtn');
            const resetBtn = document.getElementById('mainWebsiteSettingsDiscardBtn');
            const hintSpan = document.getElementById('unsavedChangesHint');

            if (settingsForm && saveBtn) {
                const getFormSignature = () => {
                    const formData = new FormData(settingsForm);
                    const entries = [];
                    for (const [key, value] of formData.entries()) {
                        if (value instanceof File) {
                            entries.push(key + ':' + value.name + ':' + value.size);
                        } else {
                            entries.push(key + ':' + value);
                        }
                    }
                    return entries.join('|');
                };

                const initialSignature = getFormSignature();

                const checkChanges = () => {
                    const currentSignature = getFormSignature();
                    const hasChanges = (currentSignature !== initialSignature);

                    saveBtn.disabled = !hasChanges;
                    if (resetBtn) {
                        resetBtn.style.display = hasChanges ? 'inline-block' : 'none';
                    }
                    if (hintSpan) {
                        if (hasChanges) {
                            hintSpan.classList.remove('d-none');
                        } else {
                            hintSpan.classList.add('d-none');
                        }
                    }
                };

                settingsForm.addEventListener('input', checkChanges);
                settingsForm.addEventListener('change', checkChanges);

                settingsForm.addEventListener('submit', function () {
                    // Show immediate saving state without visual hitch
                    saveBtn.disabled = true;
                    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
                });

                if (resetBtn) {
                    resetBtn.addEventListener('click', function () {
                        settingsForm.reset();
                        // Clear image previews that were changed
                        document.querySelectorAll('input[type="file"]').forEach(input => {
                            input.dispatchEvent(new Event('change'));
                        });
                        setTimeout(checkChanges, 50);
                    });
                }
            }
        });
    </script>
    </div>
@endsection
