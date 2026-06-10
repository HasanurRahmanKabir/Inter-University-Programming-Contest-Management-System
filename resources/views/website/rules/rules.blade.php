<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules - SUBIUPC 2025</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/rules.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a href="{{ url('/') }}">
                <img src="{{ asset('content/admin') }}/image/logosub.png" alt="University Logo" class="navbar-logo"
                    style="height: 40px; margin-left: 15px; vertical-align: middle;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon bg-light rounded"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    
                    @if($isRegistrationOpen)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('registration-info') }}">Registered Teams</a>
                        </li>
                    @endif
                    
                    <li class="nav-item"><a class="nav-link" href="{{ url('notice-info') }}">Notice</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('website/user_login') }}">Login</a></li>
                    
                    @if($isRegistrationOpen)
                        <li class="nav-item ms-lg-3">
                            <a href="{{ url('team/registration') }}" class="btn btn-register shadow">Register Now</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-3">Contest Rules & Guidelines</h1>
            <p class="lead opacity-75">Please read carefully before participating in SUBIUPC 2025</p>
        </div>
    </section>

    <section class="section-padding bg-light py-5" style="flex: 1;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    
                    @php
                        $publishedRules = $rules->where('is_published', 1);
                    @endphp

                    @if($publishedRules->count() > 0)
                        @foreach ($publishedRules as $data)
                            <div class="rules-card mb-4 p-4 shadow-sm border-0">
                                <h3><i class="fas fa-users text-primary me-2"></i> {{ $data->rules_headline }}</h3>
                                <ul>
                                    @foreach (explode("\n", $data->rules_description) as $rule)
                                        @if(!empty(trim($rule)))
                                            <li>{{ $rule }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <div class="card p-5 border-0 shadow-sm rounded-4">
                                <div class="mb-4">
                                    <i class="fas fa-clipboard-list fa-4x text-muted opacity-50"></i>
                                </div>
                                <h4 class="fw-bold text-dark">No Rules to Show</h4>
                                <p class="text-muted">Currently, no rules or guidelines have been added or published. Please check back later for updates!</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

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
                    <p class="small text-white-50 mb-3"><i class="fas fa-phone me-2"></i> +880 1711 000000</p>
                    <p class="small text-white-50 mb-1"><i class="fas fa-envelope me-2"></i> info@sub.edu.bd</p>
                    <div class="mt-3">
                        <a href="https://www.facebook.com/subedubd" class="me-3 text-white" title="Facebook"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="https://www.linkedin.com/school/state-university-of-bangladesh/" class="me-3 text-white" title="LinkedIn"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="https://www.youtube.com/@sub_edu_bd/featured" class="me-3 text-white" title="YouTube"><i class="fab fa-youtube fa-lg"></i></a>
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
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
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