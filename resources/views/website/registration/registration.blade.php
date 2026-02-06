<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SUBIUPC - Team Registration</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/registration.css">
</head>

<body>

    <div class="page-header">
        <div class="container position-relative">
            <h2 class="fw-bold mb-2">Team Registration</h2>
            <p class="opacity-75 mb-0">SUB Inter University Programming Contest - SUBIUPC 2025</p>
        </div>
    </div>

    <div class="container pb-5">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="registrationForm" action="{{ url('team/registration/store') }}" method="post"
            enctype="multipart/form-data" class="mt-4">
            @csrf

            <div class="form-card">
                <div class="form-header">
                    <i class="fas fa-university"></i> Team & Institute Information
                </div>
                <div class="form-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Team Name <span
                                    class="required-star">*</span></label>
                            <input type="text" class="form-control check-db" name="team_name"
                                placeholder="Enter unique team name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Institution Name</label>
                            <input type="text" class="form-control" name="institute_name"
                                placeholder="University / College Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Password (For Team Login) <span
                                    class="required-star">*</span></label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Set a secure password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Confirm Password <span
                                    class="required-star">*</span></label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Retype password" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-header">
                    <i class="fas fa-chalkboard-teacher"></i> Coach Information
                </div>
                <div class="form-body">
                    <div class="row g-4">
                        <div class="col-md-3 text-center">
                            <label class="form-label fw-bold small text-muted mb-2">Coach Photo</label>
                            <div class="image-upload-box" onclick="document.getElementById('coachPhoto').click()">
                                <span class="text-muted small text-center px-2"><i
                                        class="fas fa-camera fa-2x mb-2 d-block"></i>Click to Upload</span>
                                <img id="coachPreview">
                            </div>
                            <input type="file" id="coachPhoto" name="coach_photo" class="d-none"
                                onchange="previewImage(this, 'coachPreview')">
                        </div>

                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Coach Name</label>
                                    <input type="text" class="form-control" name="coach_name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Email <span
                                            class="required-star">*</span></label>
                                    <input type="email" class="form-control check-db" name="coach_email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">Phone Number <span
                                            class="required-star">*</span></label>
                                    <input type="text" class="form-control check-db" name="coach_phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">T-Shirt Size</label>
                                    <select class="form-select" name="coach_t_shirt">
                                        <option value="" selected disabled>Select Size</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-card h-100">
                        <div class="form-header bg-white border-bottom-0">
                            <i class="fas fa-user"></i> Member 01
                        </div>
                        <div class="form-body pt-0">
                            <div class="image-upload-box" onclick="document.getElementById('mem1Photo').click()">
                                <span class="text-muted small text-center px-2"><i
                                        class="fas fa-user-circle fa-2x mb-2 d-block"></i>Photo</span>
                                <img id="mem1Preview">
                            </div>
                            <input type="file" id="mem1Photo" name="mem_1_photo" class="d-none"
                                onchange="previewImage(this, 'mem1Preview')">

                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Full Name <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="mem_1_name"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Student ID <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control form-control-sm check-id check-db"
                                    name="mem_1_student_id" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Email <span
                                        class="required-star">*</span></label>
                                <input type="email" class="form-control form-control-sm check-email check-db"
                                    name="mem_1_email" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Phone</label>
                                <input type="text" class="form-control form-control-sm check-phone check-db"
                                    name="mem_1_phone">
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">T-Shirt Size</label>
                                <select class="form-select form-select-sm" name="mem_1_t_shirt">
                                    <option value="">Select</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-card h-100">
                        <div class="form-header bg-white border-bottom-0">
                            <i class="fas fa-user"></i> Member 02
                        </div>
                        <div class="form-body pt-0">
                            <div class="image-upload-box" onclick="document.getElementById('mem2Photo').click()">
                                <span class="text-muted small text-center px-2"><i
                                        class="fas fa-user-circle fa-2x mb-2 d-block"></i>Photo</span>
                                <img id="mem2Preview">
                            </div>
                            <input type="file" id="mem2Photo" name="mem_2_photo" class="d-none"
                                onchange="previewImage(this, 'mem2Preview')">

                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Full Name <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="mem_2_name"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Student ID <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control form-control-sm check-id check-db"
                                    name="mem_2_student_id" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Email <span
                                        class="required-star">*</span></label>
                                <input type="email" class="form-control form-control-sm check-email check-db"
                                    name="mem_2_email" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Phone</label>
                                <input type="text" class="form-control form-control-sm check-phone check-db"
                                    name="mem_2_phone">
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">T-Shirt Size</label>
                                <select class="form-select form-select-sm" name="mem_2_t_shirt">
                                    <option value="">Select</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-card h-100">
                        <div class="form-header bg-white border-bottom-0">
                            <i class="fas fa-user"></i> Member 03
                        </div>
                        <div class="form-body pt-0">
                            <div class="image-upload-box" onclick="document.getElementById('mem3Photo').click()">
                                <span class="text-muted small text-center px-2"><i
                                        class="fas fa-user-circle fa-2x mb-2 d-block"></i>Photo</span>
                                <img id="mem3Preview">
                            </div>
                            <input type="file" id="mem3Photo" name="mem_3_photo" class="d-none"
                                onchange="previewImage(this, 'mem3Preview')">

                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Full Name <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="mem_3_name"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Student ID <span
                                        class="required-star">*</span></label>
                                <input type="text" class="form-control form-control-sm check-id check-db"
                                    name="mem_3_student_id" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Email <span
                                        class="required-star">*</span></label>
                                <input type="email" class="form-control form-control-sm check-email check-db"
                                    name="mem_3_email" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">Phone</label>
                                <input type="text" class="form-control form-control-sm check-phone check-db"
                                    name="mem_3_phone">
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold">T-Shirt Size</label>
                                <select class="form-select form-select-sm" name="mem_3_t_shirt">
                                    <option value="">Select</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <div class="captcha-box mx-auto mb-4"
                    style="max-width: 400px; background: #f8f9fa; padding: 20px; border-radius: 8px; border: 2px solid #dee2e6;">
                    <p class="small text-muted fw-bold mb-3">Human Verification Required</p>
                    <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                        <span class="badge bg-primary" id="num1">0</span>
                        <span class="fw-bold text-dark">+</span>
                        <span class="badge bg-primary" id="num2">0</span>
                        <span class="fw-bold text-dark">=</span>
                        <input type="number" id="captchaAnswer" class="form-control" placeholder="?"
                            style="max-width: 80px;" required>
                    </div>

                    <input type="hidden" name="captcha_verified" id="captcha_verified" value="0">

                    <button type="button" class="btn btn-sm btn-outline-secondary ms-2" id="refreshCaptcha">
                        <i class="fas fa-redo me-1"></i> New
                    </button>
                    <button type="button" class="btn btn-sm btn-primary ms-2" id="verifyCaptcha">
                        <i class="fas fa-check me-1"></i> Verify
                    </button>
                    <div id="captchaMessage"></div>
                </div>

                <div class="form-check d-inline-block mb-3">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label small text-muted" for="terms">
                        I agree to the <a href="{{ url('/rules') }}">Contest Rules</a>.
                    </label>
                </div>
                <br>

                <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow">
                    <i class="fas fa-paper-plane me-2"></i> Submit Registration
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // --- 1. CSRF Setup ---
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            // --- 2. LOCAL DUPLICATE CHECK ---
            function validateLocalDuplicate(selector, itemName) {
                $(document).on('input', selector, function() {
                    var currentInput = $(this);
                    var currentValue = currentInput.val().trim();
                    var isDuplicate = false;

                    currentInput.removeClass('is-invalid');
                    if (currentInput.next('.local-error').length) {
                        currentInput.next('.local-error').remove();
                    }

                    if (currentValue === "") return;

                    $(selector).not(this).each(function() {
                        if ($(this).val().trim() === currentValue) {
                            isDuplicate = true;
                        }
                    });

                    if (isDuplicate) {
                        currentInput.addClass('is-invalid');
                        currentInput.after(
                            '<small class="text-danger local-error fw-bold" style="font-size: 11px;">⚠️ Duplicate! This ' +
                            itemName + ' is already entered.</small>');
                    }
                });
            }

            validateLocalDuplicate('.check-id', 'Student ID');
            validateLocalDuplicate('.check-email', 'Email');
            validateLocalDuplicate('.check-phone', 'Phone Number');


            // --- 3. DATABASE DUPLICATE CHECK (AJAX) ---
            $('.check-db').on('blur', function() {
                var inputField = $(this);
                var fieldName = inputField.attr('name');
                var fieldValue = inputField.val().trim();

                if (fieldValue === "" || inputField.next('.local-error').length > 0) return;

                if (inputField.next('.db-error').length) inputField.next('.db-error').remove();

                $.ajax({
                    url: '/check-duplicate-db',
                    type: 'POST',
                    data: {
                        field_name: fieldName,
                        value: fieldValue
                    },
                    success: function(response) {
                        if (response.exists) {
                            inputField.addClass('is-invalid');
                            inputField.after(
                                '<small class="text-danger db-error fw-bold" style="font-size: 11px;">⚠️ ' +
                                response.message + '</small>');
                            alert("⚠️ Warning: " + response.message);
                        } else {
                            if (inputField.next('.local-error').length === 0) {
                                inputField.removeClass('is-invalid');
                            }
                        }
                    }
                });
            });
        });

        // --- 4. CAPTCHA & PREVIEW ---
        let correctAnswer = 0;
        let isCaptchaVerified = false;

        function generateCaptcha() {
            const num1 = Math.floor(Math.random() * 50) + 1;
            const num2 = Math.floor(Math.random() * 50) + 1;
            correctAnswer = num1 + num2;
            isCaptchaVerified = false;
            document.getElementById('num1').textContent = num1;
            document.getElementById('num2').textContent = num2;
            document.getElementById('captchaAnswer').value = '';
            document.getElementById('captchaMessage').innerHTML = '';
            document.getElementById('captcha_verified').value = 0;
        }

        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById(previewId);
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.previousElementSibling.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('refreshCaptcha').addEventListener('click', generateCaptcha);

        document.getElementById('verifyCaptcha').addEventListener('click', function() {
            const userAnswer = parseInt(document.getElementById('captchaAnswer').value);
            const messageEl = document.getElementById('captchaMessage');

            if (isNaN(userAnswer)) {
                messageEl.innerHTML = '<small class="text-danger">Enter a number</small>';
                return;
            }

            if (userAnswer !== correctAnswer) {
                messageEl.innerHTML = '<small class="text-danger">Incorrect. Try again.</small>';
                isCaptchaVerified = false;
                document.getElementById('captcha_verified').value = 0;
                return;
            }

            messageEl.innerHTML = '<small class="text-success">Verified ✔</small>';
            isCaptchaVerified = true;
            document.getElementById('captcha_verified').value = 1;
        });

        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            if (!isCaptchaVerified) {
                e.preventDefault();
                alert('Please verify the CAPTCHA.');
                return;
            }
            if ($('.is-invalid').length > 0) {
                e.preventDefault();
                alert('Please fix validation errors.');
                $('html, body').animate({
                    scrollTop: $(".is-invalid").first().offset().top - 100
                }, 500);
            }
        });

        window.addEventListener('load', generateCaptcha);
    </script>
</body>

</html>
