<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Snake Catcher Application Approved</title>
</head>
<body>
    <h1>Congratulations, {{ $catcher->name }}!</h1>
    <p>Your application to become a professional snake catcher has been approved!</p>
    <p><strong>District:</strong> {{ $catcher->district }}</p>
    <p><strong>Mobile Number:</strong> {{ $catcher->mobile_number }}</p>
    <p><strong>Coverage Area:</strong> {{ $catcher->description }}</p>
    <p>You are now part of our network of certified snake catchers in Sri Lanka. You can start receiving requests from your community.</p>
    <p>Thank you for joining us!</p>
    <p>Best regards,<br>Your Snake Catcher Team</p>
</body>
</html>