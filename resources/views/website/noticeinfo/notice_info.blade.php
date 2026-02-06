<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Notices - SUBIUPC 2025</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/notice_info.css">
</head>

<body>

    <!-- Header copied from homepage -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a href="{{ url('') }}" class="text-decoration-none">
                <img src="{{ asset('content/admin') }}/image/logosub.png" alt="University Logo" class="navbar-logo"
                    style="height: 40px; margin-left: 15px; vertical-align: middle;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon bg-light rounded"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/registration-info') }}">Registerd Teams</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/rules') }}">Rules</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/website/user_login') }}">Login</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="{{ url('/team/registration') }}" class="btn btn-register shadow">Register Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page header -->
    <section class="page-header">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">Latest Notices</h1>
            <p class="lead opacity-75">Official announcements and updates for SUBIUPC 2025</p>
        </div>
    </section>

    <!-- Notice content -->
    <section class="section-padding bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <!-- Example Notice Item 1 -->
                    @foreach ($notices as $data)
                        <a href="#" class="text-decoration-none">
                            <div class="card notice-card p-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge bg-primary">{{ $data->audience }}</span>
                                    <small class="text-muted">{{ $data->notice_date }}</small>
                                </div>
                                <h5 class="fw-bold mb-1">{{ $data->title }}</h5>
                                <p class="text-muted small mb-0">{{ $data->description }}</p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
            <div class="text-center mt-4 mb-5">
                <a href="{{ url('') }}" class="btn btn-outline-primary rounded-pill">Back to Home</a>
            </div>
        </div>
    </section>

    <!-- Footer copied from homepage -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('content/admin') }}/image/logosub.png" alt="University Logo" class="navbar-logo"
                        style="height: 40px; margin-left: 15px; vertical-align: middle; margin-bottom: 25px;">
                    <p class="small text-white-50">Organizing SUBIUPC 2025 - Sub Inter-University Programming Contest.
                        Join us in
                        celebrating innovation, collaboration, and competitive programming excellence.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Online Platforms</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="https://beecrowd.com/">Beecrowd</a></li>
                        <li class="mb-2"><a href="https://toph.co/">Toph</a></li>
                        <li class="mb-2"><a href="https://leetcode.com/">Leetcode</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Location</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2">696 Kendua, Kanchan, Rupganj, Narayanganj, Dhaka-1461, Bangladesh</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Contact Info</h6>
                    <p class="small text-white-50 mb-1"><i class="fas fa-envelope me-2"></i> info@sub.edu.bd</p>
                    <p class="small text-white-50"><i class="fas fa-phone me-2"></i> +880 1711 000000</p>
                    <div class="mt-3">
                        <a href="https://www.facebook.com/subedubd" class="me-3"><i
                                class="fab fa-facebook fa-lg"></i></a>
                        <a href="https://www.linkedin.com/school/state-university-of-bangladesh/" class="me-3"><i
                                class="fab fa-linkedin fa-lg"></i></a>
                        <a href="https://www.youtube.com/@sub_edu_bd/featured" class="me-3"><i
                                class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-top border-secondary mt-4 pt-4 text-center small text-white-50">
                &copy; SUBIUPC - 2025. All Rights Reserved. | Organized by State University of Bangladesh.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('shadow');
            } else {
                document.querySelector('.navbar').classList.remove('shadow');
            }
        });
    </script>
</body>

</html>
