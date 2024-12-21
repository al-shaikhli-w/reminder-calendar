<?php

namespace App\Http\Controllers;

use App\Mail\ReminderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReminderController extends Controller
{
    public function sendReminder()
    {
        $title = 'Meeting';
        $appointment_date = '2023-12-01';
        $reminder_time = 2;
        $user_email = 'user@example.com';

        Mail::to($user_email)->send(new ReminderMail($title, $appointment_date, $reminder_time, $user_email));

        return 'Email sent successfully!';
    }
}
