<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $title;
    public string $appointment_date;
    public string $reminder_time;
    public string $user_email;

    public function __construct($title, $appointment_date, $reminder_time, $user_email)
    {
        $this->title = $title;
        $this->appointment_date = $appointment_date;
        $this->reminder_time = $reminder_time;
        $this->user_email = $user_email;
    }

    public function build()
    {
        return $this->view('mail.send-test-mail')
            ->with([
                'title' => $this->title,
                'appointment_date' => $this->appointment_date,
                'reminder_time' => $this->reminder_time,
                'user_email' => $this->user_email,
            ]);
    }
}
