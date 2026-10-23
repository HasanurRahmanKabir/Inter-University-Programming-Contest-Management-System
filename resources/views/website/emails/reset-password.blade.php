<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Password Reset Code</title>
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    <style>
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }
        html[data-theme="dark"],
        body[data-theme="dark"] {
            background-color: #0f172a !important;
            color: #e2e8f0 !important;
        }
        html[data-theme="dark"] .email-wrapper,
        body[data-theme="dark"] .email-wrapper {
            background-color: #020617 !important;
        }
        html[data-theme="dark"] .email-content,
        body[data-theme="dark"] .email-content {
            background-color: #0f172a !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #e2e8f0 !important;
        }
        html[data-theme="dark"] .body,
        body[data-theme="dark"] .body,
        html[data-theme="dark"] .body p,
        body[data-theme="dark"] .body p {
            color: #cbd5e1 !important;
        }
        html[data-theme="dark"] .otp-code,
        body[data-theme="dark"] .otp-code {
            background-color: #1e293b !important;
            color: #38bdf8 !important;
            border-color: #38bdf8 !important;
        }
        html[data-theme="dark"] .footer,
        body[data-theme="dark"] .footer {
            background-color: #1e293b !important;
            color: #94a3b8 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f7f6;
            padding: 40px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #0D8ABC;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .body {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }
        .body p {
            margin: 0 0 20px 0;
            font-size: 16px;
        }
        .otp-container {
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            display: inline-block;
            font-size: 32px;
            font-weight: bold;
            color: #0D8ABC;
            background-color: #f0f8fb;
            padding: 15px 30px;
            border-radius: 6px;
            letter-spacing: 5px;
            border: 1px dashed #0D8ABC;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #777777;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    <div class="email-wrapper">
        <div class="email-content">
            @php
                $contest = \App\Models\Contest::where('status', 1)->first();
                $title = ($contest && !empty($contest->title)) ? $contest->title : 'Your Contest Title';
            @endphp
            <div class="header">
                <h1>{{ $title }}</h1>
            </div>
            <div class="body">
                <p>Hello,</p>
                <p>We received a request to reset your password. Use the verification code below to securely access your account:</p>
                
                <div class="otp-container">
                    <div class="otp-code">{{ $otp }}</div>
                </div>
                
                <p>This code will expire in 10 minutes. If you did not request a password reset, please ignore this email or contact support if you have concerns.</p>
                
                <p>Best regards,<br>The {{ $title }} Team</p>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} {{ $title }}. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
