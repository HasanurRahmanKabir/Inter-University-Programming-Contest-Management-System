<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->website_name ?? 'Your Website Name' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('content/website/image/favicon.ico') }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/homepage.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="logo-wrapper" href="{{ url('/') }}" style="display: inline-block; line-height: 0;">
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
                    @if ($isRegistrationOpen)
                        <li class="nav-item"><a class="nav-link" href="{{ url('/registration-info') }}">Registered
                                Teams</a>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ url('/notice-info') }}">Notice</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/rules') }}">Rules</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.login') }}">Login</a></li>
                    <li class="nav-item ms-lg-3">
                        @if ($isRegistrationOpen)
                            <a href="{{ url('/team/registration') }}" class="btn btn-register shadow">Register Now</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="home" class="hero-section" style="
    @if(!empty($setting->hero_banner))
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset($setting->hero_banner) }}');
    @endif
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-10 col-lg-8">
                    @if ($isRegistrationOpen)
                        <span class="badge bg-primary bg-opacity-75 mb-3 px-3 py-2 rounded-pill d-inline-block">
                            Registration Open
                        </span>
                    @endif

                    <h1 class="display-5 fw-bold mb-4">
                        {{ !empty($setting->hero_title) ? $setting->hero_title : 'Your Hero Section Title' }}
                    </h1>

                    <p class="lead mb-5 opacity-75 text-white">
                        {{ !empty($setting->hero_description) ? $setting->hero_description : 'Your Hero Section Description' }}
                    </p>

                    <div class="d-flex justify-content-center gap-2 gap-md-3 mb-5 flex-wrap" id="countdown">
                        <div class="countdown-item">
                            <span class="countdown-number" id="days">00</span>
                            <span class="countdown-label">Days</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-number" id="hours">00</span>
                            <span class="countdown-label">Hours</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-number" id="minutes">00</span>
                            <span class="countdown-label">Minutes</span>
                        </div>
                        <div class="countdown-item">
                            <span class="countdown-number" id="seconds">00</span>
                            <span class="countdown-label">Seconds</span>
                        </div>
                    </div>

                    @if ($isRegistrationOpen)
                        <a href="{{ url('team/registration') }}"
                            class="btn btn-primary btn-lg rounded-pill px-4 px-md-5 py-2 py-md-3 fw-bold shadow-lg me-2 mb-2 mb-md-0">
                            Register Team
                        </a>
                    @else
                        <button
                            class="btn btn-secondary btn-lg rounded-pill px-4 px-md-5 py-2 py-md-3 fw-bold shadow-lg me-2 mb-2 mb-md-0"
                            disabled>
                            Registration Closed
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ !empty($setting->about_image) ? asset($setting->about_image) : asset('uploads/settings/hero2.jpg') }}"
                        class="img-fluid rounded-4 shadow" alt="About Contest">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="fw-bold mb-4">
                        {{ $setting->about_title ?? 'About Your Contest' }}
                    </h2>
                    <p class="text-muted">
                        {{ !empty($setting->about_description) ? $setting->about_description : 'Your About Section Description' }}
                    </p>
                    <div class="row mt-4 g-3">

                        <div class="col-12 col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users fa-2x text-primary me-3"></i>
                                <div>
                                    <h4 class="fw-bold mb-0">{{ $teamcount }}+</h4>
                                    <small class="text-muted">Teams</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-trophy fa-2x text-warning me-3"></i>
                                <div>
                                    <h4 class="fw-bold mb-0">
                                        {{ $setting->prize_pool_amount ?? '0' }}
                                    </h4>
                                    <small class="text-muted">Prize Pool</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="schedule" class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Event Schedule</h2>
                <p>Important dates and timeline for the contest.</p>
            </div>

            @if ($isRegistrationOpen)
                <div class="row justify-content-center">
                    @foreach ($contest as $data)
                        <div class="col-lg-8">
                            <div class="timeline-item">
                                <div class="timeline-date">
                                    {{ \Carbon\Carbon::parse($data->registration_start_date)->format('d M') }}
                                    -
                                    {{ \Carbon\Carbon::parse($data->registration_end_date)->format('d M Y') }}
                                </div>
                                <h5 class="fw-bold">
                                    {{ $setting->event_schedule_title_1 ?? 'Your Schedule Title' }}
                                </h5>
                                <p class="text-muted small">
                                    {{ $setting->event_schedule_description_1 ?? 'Your Schedule Description' }}
                                </p>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-date">
                                    {{ \Carbon\Carbon::parse($data->contest_end_date)->format('d M Y') }}
                                </div>
                                <h5 class="fw-bold text-primary">{{ $setting->event_schedule_title_2 ?? 'Your Schedule Title' }}</h5>
                                <p class="text-muted small">
                                    {{ $setting->event_schedule_description_2 ?? 'Your Schedule Description' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else

                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="alert alert-info">
                            <h5 class="fw-bold mb-2">📢 Schedule Not Available</h5>
                            <p class="mb-0">
                                The event schedule will be published once registration is officially open.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>


    <section id="notices" class="section-padding bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Latest Notices</h2>
                <p>Stay updated with official announcements.</p>
            </div>

            <div class="row d-flex justify-content-center">
                @foreach ($notice as $data)
                    <div class="col-lg-6">
                        <div class="card notice-card p-3">
                            <div class="d-flex justify-content-between flex-wrap gap-1 mb-2">
                                <span class="badge bg-primary">{{ $data->audience }}</span>
                                <small class="text-muted">{{ $data->notice_date }}</small>
                            </div>
                            <h5 class="fw-bold">{{ $data->title }}</h5>
                            <p class="text-muted small mb-0">{{ $data->description }}</p>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="text-center mt-4">
                <a href="{{ url('notice-info') }}" class="btn btn-outline-primary rounded-pill">View All Notices</a>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Photo Gallery</h2>
                <p>Memories from previous contests.</p>
            </div>

            <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    @foreach ($galleries as $key => $gallery)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($gallery->media_path) }}" class="d-block w-100 gallery-img"
                                alt="Gallery Image">
                        </div>
                    @endforeach
                </div>


                <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>


                <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-top">
        <div class="container">
            <p class="text-center text-dark fw-bold mb-4 fs-3">Our Official Partners</p>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 gap-md-5">

                @foreach ($sponsors as $sponsor)
                    @if ($sponsor->logo)
                        @if ($sponsor->link)
                            <a href="{{ $sponsor->link }}" target="_blank" rel="noopener noreferrer" title="Visit {{ $sponsor->name }}">
                                <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="sponsor-logo"
                                    style="max-height: 80px; max-width: 150px; object-fit: contain;">
                            </a>
                        @else
                            <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="sponsor-logo"
                                title="{{ $sponsor->name }} ({{ $sponsor->sponsor_category }})"
                                style="max-height: 80px; max-width: 150px; object-fit: contain;">
                        @endif
                    @endif
                @endforeach

                @if ($sponsors->isEmpty())
                    <p class="text-muted small">No partners added yet.</p>
                @endif

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
                        {{ !empty($setting->footer_description) ? $setting->footer_description : 'Your Footer Description' }}
                    </p>

                </div>

                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Online Platforms</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2">
                            <a
                                href="{{ (!empty($setting->platform_1_link) && filter_var($setting->platform_1_link, FILTER_VALIDATE_URL)) ? $setting->platform_1_link : 'javascript:void(0)' }}">
                                {{ !empty($setting->platform_1_name) ? $setting->platform_1_name : 'Platform Name 1' }}
                            </a>
                        </li>

                        <li class="mb-2">
                            <a
                                href="{{ (!empty($setting->platform_2_link) && filter_var($setting->platform_2_link, FILTER_VALIDATE_URL)) ? $setting->platform_2_link : 'javascript:void(0)' }}">
                                {{ !empty($setting->platform_2_name) ? $setting->platform_2_name : 'Platform Name 2' }}
                            </a>
                        </li>

                        <li class="mb-2">
                            <a
                                href="{{ (!empty($setting->platform_3_link) && filter_var($setting->platform_3_link, FILTER_VALIDATE_URL)) ? $setting->platform_3_link : 'javascript:void(0)' }}">
                                {{ !empty($setting->platform_3_name) ? $setting->platform_3_name : 'Platform Name 3' }}
                            </a>
                        </li>

                        <li class="mb-2">
                            <a
                                href="{{ (!empty($setting->platform_4_link) && filter_var($setting->platform_4_link, FILTER_VALIDATE_URL)) ? $setting->platform_4_link : 'javascript:void(0)' }}">
                                {{ !empty($setting->platform_4_name) ? $setting->platform_4_name : 'Platform Name 4' }}
                            </a>
                        </li>
                    </ul>
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
                            class="me-3 text-white">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>

                        <a href="{{ !empty($setting->linkedin_link) ? $setting->linkedin_link : 'javascript:void(0)' }}"
                            class="me-3 text-white">
                            <i class="fab fa-linkedin fa-lg"></i>
                        </a>

                        <a href="{{ !empty($setting->youtube_link) ? $setting->youtube_link : 'javascript:void(0)' }}"
                            class="me-3 text-white">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                    </div>

                </div>

            </div>
            <div class="border-top border-secondary mt-4 pt-4 text-center small text-white-50">
                &copy;
                {{ !empty($setting->copyright_text) ? $setting->copyright_text : 'All Rights Reserved. | Organized by Your Website Name.' }}
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const isRegistrationOpen = @json($isRegistrationOpen);

            @if ($contest->count())
                const registrationEndDate = new Date("{{ \Carbon\Carbon::parse($contest[0]->registration_end_date)->format('Y/m/d') }} 23:59:59").getTime();
            @else
                const registrationEndDate = null;
            @endif

            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');

            function setZero() {
                daysEl.innerText = '00';
                hoursEl.innerText = '00';
                minutesEl.innerText = '00';
                secondsEl.innerText = '00';
            }

            if (!isRegistrationOpen || !registrationEndDate) {
                setZero();
                return;
            }

            const timer = setInterval(function () {
                const now = new Date().getTime();
                const distance = registrationEndDate - now;

                if (distance <= 0) {
                    clearInterval(timer);
                    setZero();
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                daysEl.innerText = String(days).padStart(2, '0');
                hoursEl.innerText = String(hours).padStart(2, '0');
                minutesEl.innerText = String(minutes).padStart(2, '0');
                secondsEl.innerText = String(seconds).padStart(2, '0');

            }, 1000);

        });

        // Scroll to Top functionality - Independent Block
        document.addEventListener('DOMContentLoaded', function () {
            const scrollToTopBtn = document.getElementById("scrollToTopBtn");
            
            if (scrollToTopBtn) {
                window.addEventListener("scroll", function() {
                    if (window.scrollY > 100) {
                        scrollToTopBtn.classList.add("show");
                    } else {
                        scrollToTopBtn.classList.remove("show");
                    }
                });

                scrollToTopBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                });
            }
        });
    </script>

    <!-- Scroll to Top Button -->
    <a href="#" id="scrollToTopBtn" class="scroll-to-top shadow-lg" title="Go to top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Mobile Bottom Navigation Bar (Visible only on mobile/tablet) -->
    <div class="mobile-bottom-nav d-lg-none fixed-bottom shadow-lg" style="padding-bottom: env(safe-area-inset-bottom); z-index: 1040;">
        <div class="d-flex justify-content-around align-items-center py-2 px-2">
            <a href="{{ url('/') }}" class="nav-item text-center text-decoration-none text-primary d-flex flex-column align-items-center">
                <i class="fas fa-home fs-5 mb-1"></i>
                <span>Home</span>
            </a>
            <a href="{{ url('/notice-info') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-bullhorn fs-5 mb-1"></i>
                <span>Notice</span>
            </a>
            <a href="{{ url('/rules') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-gavel fs-5 mb-1"></i>
                <span>Rules</span>
            </a>
            @if ($isRegistrationOpen)
            <a href="{{ url('/registration-info') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-users fs-5 mb-1"></i>
                <span>Teams</span>
            </a>
            @endif
            <a href="{{ route('user.login') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-user-circle fs-5 mb-1"></i>
                <span>Login</span>
            </a>
        </div>
    </div>
    
    <style>
        /* Fix gap issue by padding the footer instead of body so background stretches */
        @media (max-width: 991.98px) {
            footer {
                padding-bottom: 75px !important;
            }
        }
        
        .mobile-bottom-nav {
            background-color: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05) !important;
        }
        
        .mobile-bottom-nav .nav-item {
            width: 20%;
            transition: all 0.2s ease-in-out;
        }

        .mobile-bottom-nav .nav-item span {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
        
        .mobile-bottom-nav .nav-item i {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .mobile-bottom-nav .nav-item:hover, .mobile-bottom-nav .nav-item:active {
            color: #0d6efd !important;
        }

        .mobile-bottom-nav .nav-item:hover i, .mobile-bottom-nav .nav-item:active i {
            transform: scale(1.15) translateY(-2px);
        }

        /* Scroll to Top Button Styles */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 15px; /* Moved further right */
            background-color: #0d6efd; /* Primary Theme Color */
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4) !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 1050;
        }

        .scroll-to-top:hover {
            background-color: #0b5ed7;
            color: white;
            transform: translateY(-3px);
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Adjust position on mobile to prevent overlapping with bottom nav */
        @media (max-width: 991.98px) {
            .scroll-to-top {
                bottom: 85px; /* Above the mobile nav bar */
                right: 10px; /* Moved further right for mobile */
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>

</body>

</html>