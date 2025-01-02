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
                alt="Website Logo" 
                style="display: block; max-width: 150px; margin: 0 auto; border: none;">
        </div>
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; color: #333333; margin: 0;">
                <strong><span style="color: #f59e0b;">Reply</span> to Your Contact Form Submission</strong>
            </h1>
        </div>
        <div style="margin-bottom: 10px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">
                <strong>Hello {{ $userName }},</strong>
            </p>
        </div>
        <div style="margin-bottom: 10px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">You have received a reply from the admin regarding your contact form submission.</p>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #333; font-weight: bold;">Reply from Admin:</p>
            <blockquote style="font-size: 16px; color: #333; border-left: 4px solid #f39c12; padding-left: 16px; margin: 0;">
                {{ $replyMessage }}
            </blockquote>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">If you have any further questions, feel free to reach out again.</p>
        </div>
        <div style="margin-top: 20px;">
            <p style="font-size: 16px; color: #555555; margin: 0;">Best regards,</p>
            <p style="font-size: 16px; color: #555555; margin: 0;">The {{ config('app.name') }} Team</p>
        </div>
    </div>
</div>
</html>