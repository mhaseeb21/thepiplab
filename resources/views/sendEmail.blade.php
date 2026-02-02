<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The PipLab</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <!-- Email container -->
    <table align="center" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border: 1px solid #dddddd; margin-top: 20px;">
        <!-- Logo Section -->
        <tr>
            <td align="center" style="padding: 20px;">
                <!-- Replace with your logo URL -->
                <img src="{{ asset('/images/Logo.png') }}" alt="PipLab Logo" style="height: 60px;">
            </td>
        </tr>

        <!-- Greeting and Title -->
        <tr>
            <td style="padding: 0 30px 20px;">
                <h2 style="color: #333333; text-align: center;">Welcome to PipLab, {{ $mailData['name'] }}!</h2>
                <p style="text-align: center; color: #555555;">We're excited to have you join our community. Below are your account details:</p>
            </td>
        </tr>

        <!-- Content Section -->
        <tr>
            <td style="padding: 0 30px 20px;">
                <p><strong>Full Name:</strong> {{ $mailData['name'] }}</p>
                <p><strong>Email:</strong> {{ $mailData['email'] }}</p>
                  <p><strong>Contact No:</strong> {{ $mailData['contact_number'] }}</p>
                <p><strong>Password:</strong> {{ $mailData['password'] }}</p>
            </td>
        </tr>

        <!-- Closing Message -->
        <tr>
            <td style="padding: 20px 30px;">
                <p style="color: #555555;">Thank you for registering with PipLab! We’re here to support you as you start this journey. Feel free to reach out if you have any questions.</p>
                <p style="color: #555555;">Warm regards,</p>
                <p style="color: #333333; font-weight: bold;">The PipLab Team</p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f4f4f4; text-align: center; padding: 10px 30px;">
                <p style="font-size: 12px; color: #777777;">&copy; 2024 PipLab. All rights reserved.</p>
                <p style="font-size: 12px; color: #777777;">123 PipLab St., City, Country</p>
            </td>
        </tr>
    </table>

</body>
</html>
