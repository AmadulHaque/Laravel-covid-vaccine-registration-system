<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Reminder</title>
</head>
<body>
    <h1>Dear {{ $user->name }} </h1>

    <p>This is a reminder that your COVID-19 vaccination appointment is scheduled for:</p>

    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($scheduledDate)->format('F j, Y') }}</p>
    <p><strong>Location:</strong> {{ $center->name }}</p>

    <p>Please make sure to arrive on time and follow all the necessary health guidelines.</p>

    <p>Thank you for taking this important step to protect yourself and others.</p>

    <p>Best regards,<br>Vaccine Center</p>
</body>
</html>
