<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBIUPC 2025 - Inter University Programming Contest</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/homepage.css">
    <style>
        .gallery-img {
            width: 100%;
            height: auto;
            object-fit: contain;
            background-color: #000;


        }

        .carousel-item {
            text-align: center;
        }

        .sponsor-logo {
            height: 80px;
            width: auto;
            filter: grayscale(100%);
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .sponsor-logo:hover {
            filter: grayscale(0%);
            transform: scale(1.1);
            opacity: 1;
        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <img src="{{ asset('uploads/settings/' . basename($setting->header_logo)) }}" alt="Logo"
                style="height: 40px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon bg-light rounded"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if ($isRegistrationOpen)
                        <li class="nav-item"><a class="nav-link" href="{{ url('/registration-info') }}">Registered
                                Teams</a>
                        </li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ url('/notice-info') }}">Notice</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/rules') }}">Rules</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/website/user_login') }}">Login</a></li>
                    <li class="nav-item ms-lg-3">
                        @if ($isRegistrationOpen)
                            <a href="{{ url('/team/registration') }}" class="btn btn-register shadow">Register Now</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="home" class="hero-section"
        style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ !empty($setting->hero_banner) ? asset($setting->hero_banner) : asset('uploads/Pictures of programming/sublogoiupc.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-10 col-lg-8">
                    @if ($isRegistrationOpen)
                        <span class="badge bg-primary bg-opacity-75 mb-3 px-3 py-2 rounded-pill d-inline-block">
                            Registration Open
                        </span>
                    @endif

                    @if(!empty($setting->hero_title))
                        <h1 class="display-5 fw-bold mb-4 text-white">
                            {{ $setting->hero_title }}
                        </h1>
                    @endif
                    @if(!empty($setting->hero_description))
                        <p class="lead mb-5 opacity-75 text-white">
                            {{ $setting->hero_description }}
                        </p>
                    @endif

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
                @if(!empty($setting->about_image))
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="{{ asset($setting->about_image) }}" class="img-fluid rounded-4 shadow"
                            alt="About Contest">
                    </div>
                @endif
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="fw-bold mb-4">
                        {{ $setting->about_title ?? 'About Your Contest' }}
                    </h2>
                    @if(!empty($setting->about_description))
                        <p class="text-muted">
                            {{ $setting->about_description }}
                        </p>
                    @endif
                    <div class="row mt-4 g-3">

                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-users fa-2x text-primary me-3"></i>
                                <div>
                                    <h4 class="fw-bold mb-0">{{ $teamcount }}+</h4>
                                    <small class="text-muted">Teams</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
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
                                <h5 class="fw-bold">Registration Phase</h5>
                                <p class="text-muted small">
                                    Online registration and payment verification period.
                                </p>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-date">
                                    {{ \Carbon\Carbon::parse($data->contest_end_date)->format('d M Y') }}
                                </div>
                                <h5 class="fw-bold text-primary">Final Contest Day</h5>
                                <p class="text-muted small">
                                    Onsite contest at SUB Permanent Campus. Reporting time 8:00 AM.
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
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary">{{ $data->audience }}</span>
                                <small class="text-muted">{{ $data->notice_date }}</small>
                            </div>
                            <h5 class="fw-bold">{{ $data->title }}</h5>
                            <p class="text-muted small mb-0">{{ $data->description }}</p>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
        <div class="text-center mt-4">
            <a href="{{ url('notice-info') }}">
                <button class="btn btn-outline-primary rounded-pill">View All Notices</button>
            </a>
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

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-5">

                @foreach ($sponsors as $sponsor)
                    @if ($sponsor->logo)
                        @if ($sponsor->link)
                            <a href="{{ $sponsor->link }}" target="_blank" title="Visit {{ $sponsor->name }}">
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
                    <img src="{{ !empty($setting->footer_logo) ? asset($setting->footer_logo) : asset('content/admin/image/logosub.png') }}"
                        alt="University Logo" class="navbar-logo"
                        style="height: 40px; margin-left: 15px; vertical-align: middle; margin-bottom: 25px;">
                    @if(!empty($setting->footer_description))
                        <p class="small text-white-50">
                            {{ $setting->footer_description }}
                        </p>
                    @endif
                </div>
                <div class="col-md-2 mb-4">
                    @if(!empty($setting->platform_1_name) || !empty($setting->platform_2_name) || !empty($setting->platform_3_name) || !empty($setting->platform_4_name))
                        <h6 class="fw-bold mb-3">Online Platforms</h6>
                        <ul class="list-unstyled small">
                            @if(!empty($setting->platform_1_name))
                                <li class="mb-2"><a
                                        href="{{ $setting->platform_1_link ?? '#' }}">{{ $setting->platform_1_name }}</a></li>
                            @endif
                            @if(!empty($setting->platform_2_name))
                                <li class="mb-2"><a
                                        href="{{ $setting->platform_2_link ?? '#' }}">{{ $setting->platform_2_name }}</a></li>
                            @endif
                            @if(!empty($setting->platform_3_name))
                                <li class="mb-2"><a
                                        href="{{ $setting->platform_3_name ?? '#' }}">{{ $setting->platform_3_name }}</a></li>
                            @endif
                            @if(!empty($setting->platform_4_name))
                                <li class="mb-2"><a
                                        href="{{ $setting->platform_4_name ?? '#' }}">{{ $setting->platform_4_name }}</a></li>
                            @endif
                        </ul>
                    @endif
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Location</h6>
                    <ul class="list-unstyled small">
                        @if(!empty($setting->location))
                            <li class="mb-2">{{ $setting->location }}</li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Contact Info</h6>
                    <p class="small text-white-50 mb-1"><i class="fas fa-envelope me-2"></i>
                        @if(!empty($setting->email))
                            {{ $setting->email }}
                        @endif
                    </p>
                    <p class="small text-white-50"><i class="fas fa-phone me-2"></i>
                        @if(!empty($setting->phone_number))
                            {{ $setting->phone_number }}
                        @endif
                    </p>
                    <div class="mt-3">
                        @if(!empty($setting->facebook_link))
                            <a href="{{ $setting->facebook_link }}" class="me-3">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                        @endif
                        @if(!empty($setting->linkedin_link))
                            <a href="{{ $setting->linkedin_link }}" class="me-3">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                        @endif
                        @if(!empty($setting->youtube_link))
                            <a href="{{ $setting->youtube_link }}" class="me-3">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>

            </div>
            <div class="border-top border-secondary mt-4 pt-4 text-center small text-white-50">
                &copy; {{ $setting->copyright_text ?? '' }}
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const isRegistrationOpen = @json($isRegistrationOpen);

            @if ($contest->count())
                const registrationEndDate = new Date("{{ \Carbon\Carbon::parse($contest[0]->registration_end_date)->format('Y/m/d') }} 23:59:59").getTime();
                                                                                                                        .getTime();
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
    </script>


</body>

</html>