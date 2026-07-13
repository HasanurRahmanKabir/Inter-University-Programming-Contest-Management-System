<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Notices</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('content/website/image/favicon.ico') }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/notice_info.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="logo-wrapper" href="{{ url('/') }}" style="display: block; line-height: 0;">
                @if(!empty($setting->header_logo))
                    <img src="{{ asset($setting->header_logo) }}" alt="Logo" class="img-fluid custom-logo">
                @else
                    <div class="custom-logo-placeholder">
                        Upload Your Logo
                    </div>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    @if($isRegistrationOpen)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/registration-info') }}">Registered Teams</a>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ url('/rules') }}">Rules</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/website/user_login') }}">Login</a></li>

                    @if($isRegistrationOpen)
                        <li class="nav-item ms-lg-3">
                            <a href="{{ url('/team/registration') }}" class="btn btn-register shadow">Register Now</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">Latest Notices</h1>
            <p class="lead opacity-75">
                Official announcements and updates for {{ $contest->title ?? 'Your Contest Title' }}
            </p>
        </div>
    </section>

    <section class="section-padding bg-light py-5" style="flex: 1;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    @php
                        $activeNotices = $notices->where('status', 1);
                    @endphp

                    @if($activeNotices->count() > 0)
                        @foreach ($activeNotices as $data)
                            <div class="card notice-card p-3 mb-3 shadow-sm border-0">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                    <span class="badge bg-primary">{{ $data->audience }}</span>
                                    <small class="text-muted" style="white-space: nowrap;"><i
                                            class="fas fa-calendar-alt me-1"></i>{{ $data->notice_date }}</small>
                                </div>
                                <h5 class="fw-bold mb-1">{{ $data->title }}</h5>
                                <p class="text-muted small mb-0">{{ $data->description }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <div class="card p-5 border-0 shadow-sm rounded-4">
                                <div class="mb-4">
                                    <i class="fas fa-bell-slash fa-4x text-muted opacity-50"></i>
                                </div>
                                <h4 class="fw-bold text-dark">No Notices Yet</h4>
                                <p class="text-muted">Currently, there are no official announcements. Please check back
                                    later for updates!</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <div class="text-center mt-4 mb-5">
                <a href="{{ url('') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i>Back to Home
                </a>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a class="logo-wrapper" href="{{ url('/') }}" style="display: inline-block; line-height: 0; margin-bottom: 25px;">
                        @if(!empty($setting->footer_logo))
                            <img src="{{ asset($setting->footer_logo) }}" alt="University Logo" class="img-fluid custom-logo">
                        @else
                            <div class="custom-logo-placeholder">
                                Upload Your Logo
                            </div>
                        @endif
                    </a>

                    <p class="small text-white-50">
                        {{ $setting->footer_description ?? 'Your Footer Description' }}
                    </p>
                </div>
                <div class="col-md-2 mb-4">
                    @if(!empty($setting->platform_1_name) || !empty($setting->platform_2_name) || !empty($setting->platform_3_name) || !empty($setting->platform_4_name))
                        <h6 class="fw-bold mb-3">Online Platforms</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_1_link)) ? $setting->platform_1_link : '#' }}">
                                    {{ !empty($setting->platform_1_name) ? $setting->platform_1_name : 'Platform Name 1' }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_2_link)) ? $setting->platform_2_link : '#' }}">
                                    {{ !empty($setting->platform_2_name) ? $setting->platform_2_name : 'Platform Name 2' }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_3_link)) ? $setting->platform_3_link : '#' }}">
                                    {{ !empty($setting->platform_3_name) ? $setting->platform_3_name : 'Platform Name 3' }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_4_link)) ? $setting->platform_4_link : '#' }}">
                                    {{ !empty($setting->platform_4_name) ? $setting->platform_4_name : 'Platform Name 4' }}
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Location</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            {{ !empty($setting->location) ? $setting->location : 'Your Location' }}
                        </li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Contact Info</h6>
                    <p class="small text-white-50 mb-1">
                        <i class="fas fa-envelope me-2"></i>
                        {{ !empty($setting->email) ? $setting->email : 'info@gmail.com' }}
                    </p>

                    <p class="small text-white-50">
                        <i class="fas fa-phone me-2"></i>
                        {{ !empty($setting->phone_number) ? $setting->phone_number : '+880 1711 000000' }}
                    </p>
                    <div class="mt-3">
                        <a href="{{ !empty($setting->facebook_link) ? $setting->facebook_link : 'javascript:void(0)' }}"
                            class="me-3 text-white" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a href="{{ !empty($setting->linkedin_link) ? $setting->linkedin_link : 'javascript:void(0)' }}"
                            class="me-3 text-white" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-linkedin fa-lg"></i>
                        </a>
                        <a href="{{ !empty($setting->youtube_link) ? $setting->youtube_link : 'javascript:void(0)' }}"
                            class="me-3 text-white" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-top border-secondary mt-4 pt-4 text-center small text-white-50">
                &copy;
                {{ !empty($setting->copyright_text) ? $setting->copyright_text : 'All Rights Reserved. | Organized by Your University Name.' }}
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('shadow');
            } else {
                document.querySelector('.navbar').classList.remove('shadow');
            }
        });
    </script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
            width: 100%;
        }
    </style>
</body>

</html>