<?php

namespace App\Http\Controllers;

use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function sendReminder()
    {
        $title = 'Reminder for your appointment -- TESTING MAIL';
        $appointment_date = '2024-12-21 12:00:00';
        $reminder_time = 4;
        $user_email = 'userTest@reminder-calendar.com';

        Mail::to($user_email)->send(new ReminderMail($title, $appointment_date, $reminder_time, $user_email));

        return 'Email sent successfully!';
    }
}
