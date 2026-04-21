<!DOCTYPE html>
<html>
<head>
    <style>
        .otp-container {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 400px;
            margin: auto;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #4e73df;
            margin: 20px 0;
            letter-spacing: 5px;
        }
    </style>
</head>
<body>
    <div class="otp-container">
        <h2>Verification Required</h2>
        <p>Please use the following OTP to complete your registration:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>This code will expire in 10 minutes.</p>
        <p>If you did not request this, please ignore this email.</p>
    </div>
</body>
</html>
