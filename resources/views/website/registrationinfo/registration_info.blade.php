<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Registered Teams</title>
    <link rel="icon" type="image/x-icon" href="{{ !empty($setting->favicon) ? asset($setting->favicon) : asset('content/website/image/favicon.ico') }}">

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/registrationinfo.css">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/dark-mode.css">
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
                    <li class="nav-item"><a class="nav-link" href="{{ url('/notice-info') }}">Notices</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/rules') }}">Rules</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.login') }}">Login</a></li>
                    
                    <li class="nav-item ms-lg-3">
                        <a href="{{ url('team/registration') }}" class="btn btn-register shadow">Register Now</a>
                    </li>
                    <li class="nav-item ms-lg-2 d-none d-lg-block">
                        <a href="#" class="nav-link theme-toggle-btn d-flex align-items-center">
                            <i class="fas fa-lightbulb theme-toggle-icon-light"></i>
                            <i class="fas fa-moon theme-toggle-icon-dark"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container">
            <h1 class="display-5 fw-bold mb-2">Registered Teams</h1>
            <p class="lead opacity-75">
                Latest registrations list for {{ $contest->title ?? 'Your Contest Title' }}
            </p>
        </div>
    </section>

    <section class="section-padding bg-light" style="flex: 1;">
        <div class="container">

            @if($teams->count() > 0)
                <div class="card p-3 shadow-sm border-0 mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                        <div class="input-group" style="max-width: 500px;">
                            <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search by team, institution or coach"
                                aria-label="Search">
                            <button id="resetSearchBtn" class="btn btn-secondary d-none" type="button" title="Clear Search"><i class="fas fa-times"></i></button>
                            <button id="searchBtn" class="btn btn-primary" type="button"><i class="fas fa-search me-2"></i>Search</button>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-dark">All</span>
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
                            <tbody id="teamTableBody">
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
                                <tr id="noDataRow" style="display: none;">
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-search fa-3x mb-3 opacity-50" style="color: #94a3b8;"></i>
                                        <h5 class="fw-bold mb-1">No Teams Found</h5>
                                        <p class="mb-0">Try adjusting your search or filter criteria.</p>
                                    </td>
                                </tr>
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
                        <p class="text-muted mb-4">
                            Currently, no teams have completed their registration for
                            {{ $contest->title ?? 'Your Contest Title' }}.
                            Be the first to join!
                        </p>
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
                                <a href="{{ (!empty($setting->platform_1_link)) ? $setting->platform_1_link : '#' }}" target="_blank" rel="noopener noreferrer">
                                    {{ !empty($setting->platform_1_name) ? $setting->platform_1_name : 'Platform Name 1' }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_2_link)) ? $setting->platform_2_link : '#' }}" target="_blank" rel="noopener noreferrer">
                                    {{ !empty($setting->platform_2_name) ? $setting->platform_2_name : 'Platform Name 2' }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_3_link)) ? $setting->platform_3_link : '#' }}" target="_blank" rel="noopener noreferrer">
                                    {{ !empty($setting->platform_3_name) ? $setting->platform_3_name : 'Platform Name 3' }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ (!empty($setting->platform_4_link)) ? $setting->platform_4_link : '#' }}" target="_blank" rel="noopener noreferrer">
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

        // Search Functionality
        let searchBtn = document.getElementById('searchBtn');
        let searchInput = document.getElementById('searchInput');
        let resetSearchBtn = document.getElementById('resetSearchBtn');

        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', function() {
                let filter = searchInput.value.toLowerCase();
                let rows = document.querySelectorAll('#teamTableBody tr');

                rows.forEach(row => {
                    let teamName = row.cells[1] ? row.cells[1].textContent.toLowerCase() : '';
                    let institution = row.cells[2] ? row.cells[2].textContent.toLowerCase() : '';
                    let coach = row.cells[3] ? row.cells[3].textContent.toLowerCase() : '';

                    if (teamName.includes(filter) || institution.includes(filter) || coach.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateNoDataMessage();
            });

            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    searchBtn.click();
                }
            });

            searchInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    if (resetSearchBtn) resetSearchBtn.classList.add('d-none');
                    let rows = document.querySelectorAll('#teamTableBody tr:not(#noDataRow)');
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                    updateNoDataMessage();
                } else {
                    if (resetSearchBtn) resetSearchBtn.classList.remove('d-none');
                }
            });
            
            if (resetSearchBtn) {
                resetSearchBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    resetSearchBtn.classList.add('d-none');
                    let rows = document.querySelectorAll('#teamTableBody tr:not(#noDataRow)');
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                    updateNoDataMessage();
                });
            }
        }

        // Badge Filter Functionality
        let statusBadges = document.querySelectorAll('.d-flex.gap-2 .badge');
        statusBadges.forEach(badge => {
            badge.style.cursor = 'pointer'; 
            badge.addEventListener('click', function() {
                if(searchInput) searchInput.value = ''; 
                if(resetSearchBtn) resetSearchBtn.classList.add('d-none');
                
                let filterText = this.textContent.trim().toLowerCase();
                let rows = document.querySelectorAll('#teamTableBody tr:not(#noDataRow)');

                rows.forEach(row => {
                    if (filterText === 'all') {
                        row.style.display = '';
                        return;
                    }

                    let statusCell = row.cells[4];
                    let match = false;
                    
                    if (statusCell) {
                        let cellBadges = statusCell.querySelectorAll('.badge');
                        cellBadges.forEach(b => {
                            if (b.textContent.trim().toLowerCase() === filterText) {
                                match = true;
                            }
                        });
                    }
                    
                    if (match) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateNoDataMessage();
            });
        });

        // Ensure full list and clean search box on page refresh
        window.addEventListener('load', function() {
            if (searchInput) {
                searchInput.value = '';
            }
            let rows = document.querySelectorAll('#teamTableBody tr:not(#noDataRow)');
            rows.forEach(row => {
                row.style.display = '';
            });
            updateNoDataMessage();
        });

        // Helper function for no data message
        function updateNoDataMessage() {
            let rows = document.querySelectorAll('#teamTableBody tr:not(#noDataRow)');
            let noDataRow = document.getElementById('noDataRow');
            if(!noDataRow) return;
            
            let visibleCount = 0;
            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    visibleCount++;
                }
            });
            
            if (visibleCount === 0) {
                noDataRow.style.display = '';
            } else {
                noDataRow.style.display = 'none';
            }
        }

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
            <a href="{{ url('/') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
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
            <a href="{{ url('/registration-info') }}" class="nav-item text-center text-decoration-none text-primary d-flex flex-column align-items-center">
                <i class="fas fa-users fs-5 mb-1"></i>
                <span>Teams</span>
            </a>
            <a href="{{ route('user.login') }}" class="nav-item text-center text-decoration-none text-secondary d-flex flex-column align-items-center">
                <i class="fas fa-user-circle fs-5 mb-1"></i>
                <span>Login</span>
            </a>

            <a href="#" class="nav-item theme-toggle-btn text-center text-decoration-none text-secondary d-flex flex-column align-items-center justify-content-center p-0 m-0 border-0" style="background:transparent;">
                <i class="fas fa-lightbulb theme-toggle-icon-light fs-5 mb-1"></i>
                <i class="fas fa-moon theme-toggle-icon-dark fs-5 mb-1"></i>
                <span>Theme</span>
            </a>
        </div>
    </div>
    <style>
        html,
        body {
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            word-wrap: break-word;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }

        /* Interactive Badge Hover Effects */
        .d-flex.gap-2 .badge {
            transition: all 0.2s ease-in-out;
        }
        .d-flex.gap-2 .badge:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            opacity: 0.9;
        }

        /* Mobile App Navbar Styles */
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
    
    <script src="{{ asset('content/website') }}/js/dark-mode.js"></script>
</body>

</html>