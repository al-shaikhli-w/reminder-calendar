<!-- resources/views/mail/send-test-mail.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reminder Email</title>
</head>
<body>
<h1>{{ $title }}</h1>
<p>Your appointment is scheduled for {{ $appointment_date }}.</p>
<p>Reminder set for {{ $reminder_time }} hours before the appointment.</p>
<p>Contact: {{ $user_email }}</p>
</body>
</html>
