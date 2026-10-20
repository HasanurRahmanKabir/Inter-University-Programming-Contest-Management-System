@extends('admin.layout.admin')
@section('content')

    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/gallery_adminpanel.css">

    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary d-none d-sm-block">Media Gallery</h5>

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

        <div class="container-fluid p-4">

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Event Photos & Videos</h4>
                    <p class="text-muted small mb-0">Manage gallery content displayed on the frontend.</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
                    <i class="fas fa-cloud-upload-alt me-2"></i> Upload Media
                </button>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse($galleries as $gallery)
                    <div class="col-md-6 col-lg-3">
                        <div class="gallery-card">
                            <div class="gallery-img-container">
                                <img src="{{ asset($gallery->media_path) }}" class="gallery-img">

                                <div class="img-overlay">
                                    <button class="btn btn-light rounded-circle me-2 view-btn"
                                        data-src="{{ asset($gallery->media_path) }}" title="View" data-bs-toggle="modal"
                                        data-bs-target="#viewImageModal">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteGalleryModal{{ $gallery->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-3">
                                <small class="text-muted d-block">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($gallery->event_date)->format('d M Y') }}
                                </small>
                                <small class="text-muted"><i class="far fa-user me-1"></i> Uploaded by Admin</small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="gallery-empty-state text-center d-flex flex-column align-items-center justify-content-center">
                            <div class="gallery-empty-icon-wrapper mb-3">
                                <i class="fas fa-photo-video gallery-empty-icon"></i>
                            </div>
                            <h4 class="fw-bold mb-2 text-dark gallery-empty-title">No Media Uploaded Yet</h4>
                            <p class="text-muted small mb-4 gallery-empty-desc" style="max-width: 440px;">
                                Your event gallery is currently empty. Upload photos and videos from recent programming contests to showcase them on the public website.
                            </p>
                            <button type="button" class="btn btn-primary px-4 py-2 shadow-sm d-inline-flex align-items-center gallery-empty-btn" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
                                <i class="fas fa-cloud-upload-alt me-2"></i> Upload First Media
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($galleries->count() > 0)
                <nav class="mt-4">
                    <ul class="pagination justify-content-end">
                        <li>{!! $galleries->links('pagination::bootstrap-5') !!}</li>
                    </ul>
                </nav>
            @endif

        </div>
    </div>

    <div class="modal fade" id="uploadMediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-wrap me-3">Upload New Media</h5>
                    <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Select Image</label>
                            <div class="upload-area" onclick="document.getElementById('mediaFile').click()"
                                style="cursor: pointer;">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                <p class="mb-0 fw-bold">Click to browse file</p>
                                <input type="file" name="media_file" id="mediaFile" class="d-none @error('media_file') is-invalid @enderror" required
                                    onchange="previewUpload(this)">
                            </div>
                            @error('media_file') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            <div id="preview-container" class="mt-2 text-center d-none">
                                <small class="text-success fw-bold">File Selected!</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Date</label>
                            <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}" required>
                            @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-light text-nowrap" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4 text-nowrap">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Image Lightbox Modal -->
    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-hidden="true" style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body p-0 text-center">
                    <div class="position-relative d-inline-block" style="max-width: 100%;">
                        <!-- Floating Close Button at Top-Right Corner of Image -->
                        <button type="button" class="btn-gallery-lightbox-close" data-bs-dismiss="modal" aria-label="Close" title="Close Preview (Esc)">
                            <i class="fas fa-times"></i>
                        </button>
                        <img src="" id="modalImage" class="img-fluid rounded-4 shadow-lg"
                            style="max-height: 80vh; width: auto; max-width: 100%; object-fit: contain; border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); display: block;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($galleries as $gallery)
        <div class="modal fade" id="deleteGalleryModal{{ $gallery->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center pb-4">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-circle text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Are you sure?</h4>
                        <p class="text-muted mb-4">You are about to delete this image from the gallery.<br>This action cannot be undone.</p>
                        
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button type="button" class="btn btn-light px-4 text-nowrap" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('admin.gallery.delete', $gallery->id) }}" method="post" class="m-0">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger px-4 text-nowrap">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>


        // Dynamic View Image Modal
        document.addEventListener('DOMContentLoaded', function() {
            const viewBtns = document.querySelectorAll('.view-btn');
            const modalImage = document.getElementById('modalImage');

            viewBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const src = this.getAttribute('data-src');
                    modalImage.src = src;
                });
            });
        });

        // Simple File Upload Preview Text
        function previewUpload(input) {
            if (input.files && input.files[0]) {
                document.getElementById('preview-container').classList.remove('d-none');
            }
        }
    </script>

    <style>
        .btn-gallery-lightbox-close {
            position: absolute;
            top: -16px;
            right: -16px;
            z-index: 1090;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.95);
            color: #ffffff !important;
            border: 2px solid rgba(255, 255, 255, 0.65);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            line-height: 1;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            padding: 0;
        }

        .btn-gallery-lightbox-close:hover {
            background: #ef4444;
            color: #ffffff !important;
            border-color: #ef4444;
            transform: scale(1.12) rotate(90deg);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.65);
        }

        .btn-gallery-lightbox-close:active {
            transform: scale(0.95);
        }

        @media (max-width: 576px) {
            .btn-gallery-lightbox-close {
                top: -14px;
                right: -14px;
                width: 38px;
                height: 38px;
                font-size: 1.05rem;
            }
        }

        /* Gallery Empty State - Centered Industry Standard */
        .gallery-empty-state {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 4.5rem 1.5rem;
            min-height: 420px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        .gallery-empty-icon-wrapper {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 197, 253, 0.18) 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(59, 130, 246, 0.18);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.12);
        }
        .gallery-empty-icon {
            font-size: 2.5rem;
            color: #3b82f6;
        }
        .gallery-empty-title {
            letter-spacing: -0.3px;
        }
        .gallery-empty-desc {
            color: #64748b !important;
            line-height: 1.6;
        }
        .gallery-empty-btn {
            font-weight: 500;
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .gallery-empty-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.35) !important;
        }

        /* Dark Mode for Gallery Empty State */
        body[data-theme="dark"] .gallery-empty-state {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3) !important;
        }
        body[data-theme="dark"] .gallery-empty-icon-wrapper {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(30, 41, 59, 0.5) 100%) !important;
            border-color: rgba(59, 130, 246, 0.35) !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4) !important;
        }
        body[data-theme="dark"] .gallery-empty-icon {
            color: #60a5fa !important;
        }
        body[data-theme="dark"] .gallery-empty-title {
            color: #ffffff !important;
        }
        body[data-theme="dark"] .gallery-empty-desc {
            color: #94a3b8 !important;
        }
    </style>
@endsection

