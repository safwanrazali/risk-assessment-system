<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .content {
            margin: 20px 0;
        }
        .credentials {
            background-color: #ecf0f1;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin: 20px 0;
            border-radius: 3px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Risk Assessment System</h1>
        </div>

        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>Your account has been created successfully. Please log in with the credentials below and <strong>change your password immediately</strong> upon first login.</p>

            <div class="credentials">
                <h3 style="margin-top: 0;">Your Login Credentials:</h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Temporary Password:</strong> <code style="background-color: #fff; padding: 5px; border-radius: 3px;">{{ $temporaryPassword }}</code></p>
            </div>

            <p>For security reasons, you will be required to change your password on your first login. Please follow these steps:</p>
            <ol>
                <li>Log in using the email and temporary password provided above</li>
                <li>Go to your profile settings</li>
                <li>Change your password to a strong, secure password</li>
            </ol>

            <p>If you have any questions or issues accessing the system, please contact the administration team.</p>

            <p>Best regards,<br>
            <strong>Risk Assessment System Administration</strong></p>
        </div>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this address.</p>
            <p>&copy; {{ date('Y') }} Risk Assessment System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
