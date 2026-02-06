@extends('admin.layout.admin')
@section('content')

    <link rel="stylesheet" href="{{ asset('content/admin') }}/css/gallery_adminpanel.css">

    <div class="main-content">

        <nav class="navbar navbar-expand-lg top-navbar">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none me-2" id="sidebarToggle"><i
                        class="fas fa-bars"></i></button>
                <h5 class="mb-0 text-secondary">Media Gallery</h5>
            </div>
        </nav>

        <div class="container-fluid p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-0 text-dark">Event Photos & Videos</h4>
                    <p class="text-muted small mb-0">Manage gallery content displayed on the frontend.</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
                    <i class="fas fa-cloud-upload-alt me-2"></i> Upload Media
                </button>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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

                                    <form action="{{ route('admin.gallery.delete', $gallery->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-circle" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
                        <p class="text-muted">No media found. Please upload some images.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <div class="modal fade" id="uploadMediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Upload New Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                <input type="file" name="media_file" id="mediaFile" class="d-none" required
                                    onchange="previewUpload(this)">
                            </div>
                            <div id="preview-container" class="mt-2 text-center d-none">
                                <small class="text-success fw-bold">File Selected!</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Date</label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">Upload</button>
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

    <script>
        // Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('sidebarToggle');
        if (toggleBtn) {
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
            toggleBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }

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
