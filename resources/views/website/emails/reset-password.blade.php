<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Code</title>
    <style>
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
