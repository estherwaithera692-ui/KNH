<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulations!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .highlight {
            background: #e8f5e8;
            padding: 15px;
            border-left: 4px solid #27ae60;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Congratulations!</h1>
        <h2>Your Bio Data Application Has Been Approved</h2>
    </div>

    <div class="content">
        <p>Dear {{ $bioData->firstName }} {{ $bioData->lastName }},</p>

        <p>We are pleased to inform you that your bio data application has been <strong>approved</strong> by our administration team.</p>

        <div class="highlight">
            <h3>Application Details:</h3>
            <ul>
                <li><strong>Identification:</strong> {{ $bioData->identification }}</li>
                <li><strong>Nationality:</strong> {{ $bioData->nationality }}</li>
                <li><strong>Resident Type:</strong> {{ $bioData->resident_type }}</li>
                <li><strong>Status:</strong> Approved</li>
            </ul>
        </div>

        <p>Your application has been successfully processed and you can now proceed with the next steps in your registration process.</p>

        <p>If you have any questions or need further assistance, please don't hesitate to contact our support team.</p>

        <p>Thank you for choosing our registration system!</p>

        <p>Best regards,<br>
        The Registration Team</p>
    </div>

    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
