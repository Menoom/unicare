<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0a0f1c;
            color: #e0e7ef;
        }
        .email-container {
            max-width: 500px;
            margin: 40px auto;
            background: linear-gradient(135deg, #1a0a2e 0%, #1e1145 50%, #12082a 100%);
            border-radius: 16px;
            border: 1px solid rgba(124, 58, 237, 0.3);
            overflow: hidden;
        }
        .email-header {
            text-align: center;
            padding: 32px 24px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .email-header h1 {
            font-size: 22px;
            color: #f0f4f8;
            margin: 0 0 4px;
        }
        .email-header p {
            color: #8899aa;
            font-size: 13px;
            margin: 0;
        }
        .email-body {
            padding: 32px 24px;
            text-align: center;
        }
        .email-body p {
            font-size: 14px;
            color: #c0c8d4;
            line-height: 1.6;
            margin: 0 0 24px;
        }
        .otp-code {
            display: inline-block;
            background: rgba(124, 58, 237, 0.15);
            border: 2px solid rgba(124, 58, 237, 0.4);
            border-radius: 12px;
            padding: 16px 40px;
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 10px;
            color: #a78bfa;
            margin-bottom: 24px;
        }
        .expire-note {
            font-size: 12px;
            color: #5a6a7a;
            margin: 0;
        }
        .expire-note strong {
            color: #f59e0b;
        }
        .email-footer {
            padding: 16px 24px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        .email-footer p {
            font-size: 11px;
            color: #5a6a7a;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🩺 UniCare</h1>
            <p>Doctor Registration Verification</p>
        </div>
        <div class="email-body">
            <p>Use the following one-time password to verify your email and complete your doctor registration.</p>
            <div class="otp-code">{{ $otp }}</div>
            <p class="expire-note">This code expires in <strong>2 minutes</strong>. Do not share it with anyone.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} UniCare. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
