<x-mail::message>
    # Erinnerung!

    ## Details zur Erinnerung:
    - Bezeichnung: {{ $title }}
    - Datum: {{ $appointment_date }}
    - Erinnerung: {{ $reminder_time }} {{ $reminder_time == 1 ? 'Tag' : 'Tage' }} vor dem Termin
    - E-Mail-Adresse: {{ $user_email }}

    Vielen Dank, dass du unseren Service nutzt!

    Beste Grüße,
    {{ config('app.name') }}
</x-mail::message>
