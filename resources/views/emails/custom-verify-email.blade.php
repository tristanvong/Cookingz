<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border: 1px solid #dddddd;">


        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; color: #333333; margin: 0;">
                <strong><span style="color: #f59e0b;">Verify</span> Your Email Address</strong>
            </h1>
        </div>
        <div style="margin-bottom: 10px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">
                <strong>Hello {{ $name }},</strong>
            </p>
        </div>
        <div style="margin-bottom: 10px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">Thank you for signing up! Please click the button below to verify your email address.</p>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #333; font-weight: bold;">Verify Your Email:</p>
            <p style="font-size: 16px; color: #333;">
                <a href="{{ $verificationUrl }}" style="background-color: #f59e0b; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 4px;">Verify Email Address</a>
            </p>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">If you did not create an account, you can ignore this email.</p>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">Best regards,</p>
            <p style="font-size: 16px; color: #555555; margin: 0;">The {{ config('app.name') }} Team</p>
        </div>
    </div>
</body>
</html>
