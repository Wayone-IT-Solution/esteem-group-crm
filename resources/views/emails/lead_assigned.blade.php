<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Lead Assigned</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }
        .header {
            text-align: center;
            background-color: #003366;
            color: white;
            padding: 15px;
            border-radius: 6px 6px 0 0;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>New Lead Assigned</h2>
        </div>
        <div class="content">
            <p>Hi {{ $assigneeName }},</p>

            <p>You have been assigned a new lead by the Esteem Group team.</p>

            <p>Please log in to your dashboard to take necessary action.</p>

            <p>Thank you,<br>Esteem Group</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Esteem Group. All rights reserved.
        </div>
    </div>
</body>
</html>
