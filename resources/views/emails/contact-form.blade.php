<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Complaint Received</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #333333; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 0;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <h1 style="margin: 0 0 20px; color: #003366; font-size: 24px;">New Complaint Received</h1>
                            <p style="margin: 0 0 20px;">A new complaint has been submitted through our website. Details are as follows:</p>
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                                <tr>
                                    <th style="text-align: left; padding: 10px; background-color: #f0f0f0; border: 1px solid #dddddd;">Name:</th>
                                    <td style="padding: 10px; border: 1px solid #dddddd;">{{ $contactData['name'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; padding: 10px; background-color: #f0f0f0; border: 1px solid #dddddd;">Username:</th>
                                    <td style="padding: 10px; border: 1px solid #dddddd;">
                                        {{ Auth::check() ? Auth::user()->name : 'Guest User' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; padding: 10px; background-color: #f0f0f0; border: 1px solid #dddddd;">Email:</th>
                                    <td style="padding: 10px; border: 1px solid #dddddd;">{{ $contactData['email'] }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left; padding: 10px; background-color: #f0f0f0; border: 1px solid #dddddd;">Message:</th>
                                    <td style="padding: 10px; border: 1px solid #dddddd;">{{ $contactData['description'] }}</td>
                                </tr>
                            </table>
                            <p style="margin: 0 0 20px;">Please address this message as soon as possible. </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html> 