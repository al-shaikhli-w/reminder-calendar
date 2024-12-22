<!-- resources/views/mail/send-test-mail.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>Erinnerungs-E-Mail</title>
    </head>
    <body>
        <h1>{{ $title }}</h1>
        <p>Ihr Termin ist für den {{ $appointment_date }} geplant.</p>
        <p>Erinnerung {{ $reminder_time }} Stunden vor dem Termin gesetzt.</p>
        <p>Kontakt: {{ $user_email }}</p>
    </body>
</html>
