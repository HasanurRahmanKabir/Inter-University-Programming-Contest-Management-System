<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $setting->website_name ?? 'Your Website Name' }} - Verify OTP</title>

    <link href="{{ asset('content/website') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('content/website') }}/css/userlogin.css">
    <style>
        .otp-input {
            width: 45px;
            height: 55px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 0 5px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .otp-input:focus {
            border-color: #0D8ABC;
            box-shadow: 0 0 0 0.2rem rgba(13, 138, 188, 0.25);
            outline: none;
        }
        @media (max-width: 400px) {
            .otp-input {
                width: 38px;
                height: 48px;
                font-size: 20px;
                margin: 0 3px;
            }
        }
        @media (max-width: 320px) {
            .otp-input {
                width: 32px;
                height: 42px;
                font-size: 18px;
                margin: 0 2px;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-card">
            <div class="brand-logo">
                @if(!empty($setting->header_logo))
                    <img src="{{ asset($setting->header_logo) }}" alt="Header Logo" class="w-100 h-100 rounded-circle">
                @else
                    <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center border"
                        style="background: #f8f9fa; color: #6c757d; font-size: 10px; text-align: center;">
                        Upload Your Logo
                    </div>
                @endif
            </div>

            <h4 class="text-center fw-bold mb-1">Verify OTP</h4>
            <p class="text-center text-muted small mb-4">
                We've sent a 6-digit verification code to <strong style="word-break: break-all;">{{ session('reset_email') }}</strong>.
            </p>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('forgot.password.verify.submit') }}" method="POST" id="otpForm">
                @csrf
                <div class="mb-4 d-flex justify-content-center flex-wrap" style="gap: 8px;">
                    <input type="text" class="otp-input" maxlength="1" onkeyup="moveToNext(this, 'otp2')" id="otp1" autofocus>
                    <input type="text" class="otp-input" maxlength="1" onkeyup="moveToNext(this, 'otp3', 'otp1')" id="otp2">
                    <input type="text" class="otp-input" maxlength="1" onkeyup="moveToNext(this, 'otp4', 'otp2')" id="otp3">
                    <input type="text" class="otp-input" maxlength="1" onkeyup="moveToNext(this, 'otp5', 'otp3')" id="otp4">
                    <input type="text" class="otp-input" maxlength="1" onkeyup="moveToNext(this, 'otp6', 'otp4')" id="otp5">
                    <input type="text" class="otp-input" maxlength="1" onkeyup="moveToNext(this, '', 'otp5')" id="otp6">
                    <input type="hidden" name="otp" id="hiddenOtp">
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill mb-3" onclick="combineOtp()">
                    Verify Code <i class="fas fa-check-circle ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-3 border-top pt-3">
                <small class="text-muted">Didn't receive the code?
                    <a href="{{ route('forgot.password') }}" class="text-primary text-decoration-none fw-bold">Try Again</a>
                </small>
            </div>
        </div>
    </div>
    <script src="{{ asset('content/website') }}/js/bootstrap.bundle.min.js"></script>
    <script>
        function moveToNext(current, nextFieldID, prevFieldID) {
            if (current.value.length >= 1) {
                if (nextFieldID) {
                    document.getElementById(nextFieldID).focus();
                }
            } else if (current.value.length === 0 && prevFieldID) {
                if(event.key === "Backspace") {
                    document.getElementById(prevFieldID).focus();
                }
            }
        }
        
        function combineOtp() {
            let otp = '';
            for (let i = 1; i <= 6; i++) {
                otp += document.getElementById('otp' + i).value;
            }
            document.getElementById('hiddenOtp').value = otp;
        }

        // Handle backspace properly for all inputs
        document.querySelectorAll('.otp-input').forEach(input => {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '') {
                    let prev = this.previousElementSibling;
                    if (prev && prev.classList.contains('otp-input')) {
                        prev.focus();
                    }
                }
            });
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                let pasteData = (e.clipboardData || window.clipboardData).getData('text');
                if (pasteData.length > 0) {
                    let chars = pasteData.split('');
                    let inputs = document.querySelectorAll('.otp-input');
                    for (let i = 0; i < inputs.length; i++) {
                        if (chars[i] && !isNaN(chars[i])) {
                            inputs[i].value = chars[i];
                        }
                    }
                    combineOtp();
                }
            });
        });

        // Redirect to login page after 5 minutes (300000 milliseconds) of inactivity
        setTimeout(function() {
            window.location.href = "{{ route('user.login') }}";
        }, 300000);
    </script>
</body>

</html>
