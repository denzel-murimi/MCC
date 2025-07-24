<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Website</title>
</head>
<body>
<h4>New User Onboarding</h4>

<p>Dear {{ $user->name }},</p>

<p>Please click the link below to login to your dashboard with the following credentials:</p>

<p>Email: <span><YOUR EMAIL></span></p>

<p>Password: mAthar3car3 <span>This should be only used once</span></p>

<p>Be sure to change your password after logging in. And remember to update your profile information.</p>

<a href="{{ filament('content')->getLoginUrl() }}" target="_blank">New Login Link</a>

<p>
Enable Two-Factor Authentication from your profile for added security.
</p>

<p>If you did not request this account, you can ignore this email.</p>
</body>
</html>
