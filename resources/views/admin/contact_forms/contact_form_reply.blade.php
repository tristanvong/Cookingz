<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Reply</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; color: #333; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h2 style="font-size: 24px; color: #2c3e50;">Hello {{ $userName }},</h2>
        <p style="font-size: 16px; color: #555;">You have received a reply from the admin regarding your contact form submission.</p>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #333; font-weight: bold;">Reply from Admin:</p>
            <blockquote style="font-size: 16px; color: #333; border-left: 4px solid #f39c12; padding-left: 16px; margin: 0;">
                {{ $replyMessage }}
            </blockquote>
        </div>
        <p style="font-size: 16px; color: #555;">If you have any further questions, feel free to reach out again.</p>
        <p style="font-size: 16px; color: #555;">Best regards,</p>
        <p style="font-size: 16px; color: #555;">The {{ config('app.name') }} Team</p>
    </div>
</body>
</html>
