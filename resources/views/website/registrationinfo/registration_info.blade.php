<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registered Teams - SUBIUPC 2025</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/registrationinfo.css">
</head>

<body>

    <!-- Header copied from homepage -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a href="{{ url('') }}">
                <img src="{{ asset('content/admin') }}/image/logosub.png" alt="University Logo" class="navbar-logo"
                    style="height: 40px; margin-left: 15px; vertical-align: middle;">
            </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon bg-light rounded"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/notice-info') }}">Notices</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/rules') }}">Rules</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('website/user_login') }}">Login</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="{{ url('team/registration') }}" class="btn btn-register shadow">Register Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page header -->
    <section class="page-header">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">Registered Teams</h1>
            <p class="lead opacity-75">Latest registrations list for SUBIUPC 2025</p>
        </div>
    </section>

    <!-- Teams table -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="card p-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="input-group" style="max-width: 500px;">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search by team, institution or coach"
                            aria-label="Search">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="badge badge-verified">Selected</span>
                        <span class="badge badge-verified">Pending</span>
                        <span class="badge badge-paid">Paid</span>
                        <span class="badge badge-pending">Unpaid</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Team Name</th>
                                <th scope="col">Institution</th>
                                <th scope="col">Coach</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $data)
                                <tr>
                                    <th scope="row">{{ $data->team_id }}</th>
                                    <td>{{ $data->team_name }}</td>
                                    <td>{{ $data->institute_name }}</td>
                                    <td>{{ $data->coach_name }}</td>
                                    <td>
                                        <!-- Selected Badge -->
                                        @if ($data->is_selected)
                                            <span class="badge bg-success">Selected</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif

                                        <!-- Paid Badge -->
                                        @if ($data->is_paid)
                                            <span class="badge bg-primary">Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mt-4 mb-5">
                <a href="{{ url('/team/registration') }}" class="btn btn-outline-primary rounded-pill">Go to
                    Registration</a>
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
                        Join us in celebrating innovation, collaboration, and competitive programming excellence.</p>
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
