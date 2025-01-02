<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div style="font-family: sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border: 1px solid #dddddd;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img 
                src="https://raw.githubusercontent.com/tristanvong/Cookingz/refs/heads/main/public/images/logo-white-stroke.png" 
                alt="Cookingz Logo" 
                style="display: block; max-width: 150px; margin: 0 auto; border: none;">
        </div>
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; color: #333333; margin: 0;">
                <strong><span style="color: #f59e0b;">New Message</span> from {{ $name }}</strong>
            </h1>
        </div>
        <div style="margin-bottom: 10px;">
            <p style="font-size: 16px; color: #555555; margin: 0;"><strong>Email:</strong> {{ $email }}</p>
        </div>
        <div>
            <p style="font-size: 16px; color: #555555; margin: 0;"><strong>Message:</strong></p>
            <p style="font-size: 16px; color: #555555; margin-top: 10px;">{{ $content }}</p>
        </div>
    </div>
</div>
</html>