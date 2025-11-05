<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Update</title>
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
            background: linear-gradient(135deg, #e74c3c, #c0392b);
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
            background: #ffeaea;
            padding: 15px;
            border-left: 4px solid #e74c3c;
            margin: 20px 0;
        }
        .next-steps {
            background: #fff3cd;
            padding: 15px;
            border-left: 4px solid #ffc107;
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
        <h1>📋 Application Update</h1>
        <h2>Your Bio Data Application Has Been Rejected</h2>
    </div>

    <div class="content">
        <p>Dear {{ $bioData->firstName }} {{ $bioData->lastName }},</p>

        <p>We regret to inform you that your bio data application has been <strong>rejected</strong> after review by our administration team.</p>

        <div class="highlight">
            <h3>Application Details:</h3>
            <ul>
                <li><strong>Identification:</strong> {{ $bioData->identification }}</li>
                <li><strong>Nationality:</strong> {{ $bioData->nationality }}</li>
                <li><strong>Resident Type:</strong> {{ $bioData->resident_type }}</li>
                <li><strong>Status:</strong> Rejected</li>
            </ul>
        </div>

        <div class="next-steps">
            <h3>What You Can Do Next:</h3>
            <ul>
                <li>Review your submitted information for any errors or missing details</li>
                <li>Update your bio data with corrected information</li>
                <li>Re-submit your application for review</li>
                <li>Contact our support team if you need assistance</li>
            </ul>
        </div>

        <p>We encourage you to review and update your application. Our team is here to help you through the process.</p>

        <p>If you have any questions about this decision or need guidance on how to improve your application, please don't hesitate to contact our support team.</p>

        <p>Thank you for your interest in our registration system.</p>

        <p>Best regards,<br>
        The Registration Team</p>
    </div>

    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
