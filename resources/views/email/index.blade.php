<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset Link</title>
</head>
<body>
<h1>Reset Your Password</h1>
<p>
    Dear User,
    <br/>
    You requested for password reset. Please click on the link below or copy it to your browser to reset your password.
</p>
<a href="{{ url('reset-password/'.$token) }}">
    Click Here to reset your password.
</a>
<p>
    This password reset link will expire in 10 minutes.
</p>
<p>
    If you didn't request to reset your password, please ignore this email.
</p>
<p>
    Best regards,
    <br/>
    SKOLA
</p>
</body>
</html>
