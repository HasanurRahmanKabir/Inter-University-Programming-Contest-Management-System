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
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-images mb-3 text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                        <h5 class="fw-bold mb-1">No media found</h5>
                        <p class="text-muted small mb-0">Your gallery is currently empty. Please upload some images or videos.</p>
                    </div>
                @endforelse
            </div>

            <nav class="mt-4">
                <ul class="pagination justify-content-end">
                    <li>{!! $galleries->links('pagination::bootstrap-5') !!}</li>
                </ul>
            </nav>

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

    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal"></button>
                    <img src="" id="modalImage" class="img-fluid rounded shadow-lg w-100">
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
@endsection

