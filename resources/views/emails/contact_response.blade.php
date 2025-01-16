<!DOCTYPE html>
<html>
<head>
    <title>Response Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #e4e4e4;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .content {
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://cdn.discordapp.com/attachments/1065194449937907756/1259507921096544337/logo_utama.png?ex=668befa8&is=668a9e28&hm=33c47604da93fa17f897d4c3f729e33fe50fe948af6c06963f6b991eb61a82c5&" alt="Kanna Logo">
            <h1>Our Response</h1>
        </div>
        <div class="content">
            <p>Dear, {{ $name }},</p>
            <p>Thank you for sending a message to Kanna Dentist. This is our response:</p>
            <p>"{{ $messages }}"</p>
            <p>{{ $responseMessage }}</p>
            <p>Best regards,<br/>Kanna Dentist</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Kanna Dentist. All rights reserved.</p>
        </div>
    </div>
</body>
</html>