<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Registered Teamss</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/registrationinfo.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a href="{{ url('') }}" class="text-decoration-none">
                @if(!empty($setting->header_logo))
                    <img src="{{ asset($setting->header_logo) }}" alt="University Logo" class="navbar-logo"
                        style="height: 40px; margin-left: 15px; vertical-align: middle;">
                @else
                    <div
                        style="height: 40px; margin-left: 15px; vertical-align: middle; display: inline-flex; align-items: center; justify-content: center; background: #f8f9fa; border: 1px dashed #ced4da; padding: 0 15px; border-radius: 4px; color: #6c757d; font-size: 14px; font-weight: 500;">
                        Upload Your Logo
                    </div>
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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

    <section class="page-header">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">Registered Teams</h1>
            <p class="lead opacity-75">
                Latest registrations list for {{ $setting->website_name ?? 'Your Website Name' }}
            </p>
        </div>
    </section>

    <section class="section-padding bg-light" style="flex: 1;">
        <div class="container">

            @if($teams->count() > 0)
                <div class="card p-3 shadow-sm border-0 mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <div class="input-group" style="max-width: 500px;">
                            <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search by team, institution or coach"
                                aria-label="Search">
                            <button class="btn btn-primary" type="button"><i class="fas fa-search me-2"></i>Search</button>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge bg-success">Selected</span>
                            <span class="badge bg-secondary">Pending</span>
                            <span class="badge bg-primary">Paid</span>
                            <span class="badge bg-warning text-dark">Unpaid</span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Team Name</th>
                                    <th scope="col">Institution</th>
                                    <th scope="col">Coach</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->team_name }}</td>
                                        <td>{{ $data->institute_name }}</td>
                                        <td>{{ $data->coach_name }}</td>
                                        <td>
                                            @if ($data->is_selected)
                                                <span class="badge bg-success">Selected</span>
                                            @else
                                                <span class="badge bg-secondary">Pending</span>
                                            @endif

                                            @if ($data->is_paid)
                                                <span class="badge bg-primary">Paid</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Unpaid</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-4 mb-5">
                    <a href="{{ url('/team/registration') }}" class="btn btn-outline-primary rounded-pill">Go to
                        Registration</a>
                </div>

            @else
                <div class="text-center py-5">
                    <div class="card p-5 border-0 shadow-sm rounded-4" style="max-width: 600px; margin: auto;">
                        <div class="mb-4">
                            <i class="fas fa-users-slash fa-4x text-muted opacity-50"></i>
                        </div>
                        <h4 class="fw-bold text-dark">No Teams Registered Yet</h4>
                        <p class="text-muted mb-4">Currently, no teams have completed their registration for SUBIUPC 2025.
                            Be the first to join!</p>
                        <a href="{{ url('/team/registration') }}" class="btn btn-primary">Register Your Team</a>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    @if(!empty($setting->footer_logo))
                        <img src="{{ asset($setting->footer_logo) }}" alt="University Logo" class="navbar-logo"
                            style="height: 40px; margin-left: 15px; vertical-align: middle; margin-bottom: 25px;">
                    @else
                        <div
                            style="height: 40px; margin-left: 15px; vertical-align: middle; margin-bottom: 25px; display: inline-flex; align-items: center; justify-content: center; background: #f8f9fa; border: 1px dashed #ced4da; padding: 0 15px; border-radius: 4px; color: #6c757d; font-size: 14px; font-weight: 500;">
                            Upload Your Logo
                        </div>
                    @endif

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
        }

        body {
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }
    </style>
</body>

</html>