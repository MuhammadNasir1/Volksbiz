<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #13242C;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
            color: #333333;
        }
        .content p {
            margin: 0 0 15px;
        }
        .button {
            display: block;
            text-align: center;
            margin: 20px auto;
        }
        .button a {
            cursor: pointer;
            display: inline-block;
            background-color: #13242C;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .button a:hover {
            background-color: #0056b3;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666666;
        }
        .footer a {
            color: #13242C;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Hi {{$user_name}},</p>
            <p>You recently requested to reset your password. Click the button below to reset it:</p>
            <div class="button">
                <a href="{{$url}}">Reset Password</a>
            </div>
            <p>If you didn’t request this, please ignore this email or contact support if you have questions.</p>
            <p>Thank you,<br>The Volksbiz Team</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you’re having trouble clicking the button, copy and paste the following link into your browser:</p>
            <p><a href="{{$url}}" target="_blank">[Reset Link]</a></p>
            <p>© 2024 Volksbiz All rights reserved.</p>
        </div>
    </div>
</body>
</html>

