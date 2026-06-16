@extends('admin.layout.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/rulesregulations_admin.css">

    <div class="main-content">
        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Website Settings</h5>
            </div>
        </nav>

        <div class="container-fluid p-3 p-md-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
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
                        <div class="col-12 col-sm-6 col-lg-3"><label class="form-label small fw-bold">Header
                                Logo</label><input type="file" name="header_logo" class="form-control shadow-none"></div>
                        <div class="col-12 col-sm-6 col-lg-3"><label class="form-label small fw-bold">Footer
                                Logo</label><input type="file" name="footer_logo" class="form-control shadow-none"></div>
                        <div class="col-12 col-sm-6 col-lg-3"><label class="form-label small fw-bold">Hero
                                Banner</label><input type="file" name="hero_banner" class="form-control shadow-none"></div>
                        <div class="col-12 col-sm-6 col-lg-3"><label class="form-label small fw-bold">About Us
                                Image</label><input type="file" name="about_image" class="form-control shadow-none"></div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-pen-nib me-2"></i>Website Content</h6>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">Hero Title</label><input
                                type="text" name="hero_title" class="form-control shadow-none"
                                value="{{ $setting->hero_title ?? '' }}"></div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">About Us Title</label><input
                                type="text" name="about_title" class="form-control shadow-none"
                                value="{{ $setting->about_title ?? '' }}"></div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">Hero
                                Description</label><textarea name="hero_description" class="form-control shadow-none"
                                rows="2">{{ $setting->hero_description ?? '' }}</textarea></div>
                        <div class="col-12 col-lg-6"><label class="form-label small fw-bold">About Us
                                Description</label><textarea name="about_description" class="form-control shadow-none"
                                rows="2">{{ $setting->about_description ?? '' }}</textarea></div>
                    </div>

                    <h6 class="text-primary fw-bold mt-4 mb-3"><i class="fas fa-address-card me-2"></i>Contact Details</h6>
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
                                        <div class="col-6">
                                            <label class="form-label small text-muted">Platform Name</label>
                                            <input type="text" name="platform_{{$i}}_name" class="form-control shadow-none"
                                                placeholder="e.g. Steam" value="{{ $setting->{'platform_' . $i . '_name'} ?? '' }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small text-muted">Platform Link</label>
                                            <input type="text" name="platform_{{$i}}_link" class="form-control shadow-none"
                                                placeholder="https://..."
                                                value="{{ $setting->{'platform_' . $i . '_link'} ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm"><i class="fas fa-save me-2"></i>Save
                            Changes</button>
                        <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection