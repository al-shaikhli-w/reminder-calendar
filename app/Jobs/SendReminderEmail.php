<?php

namespace App\Jobs;

use App\Mail\MailSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Queueable, InteractsWithQueue, Queueable, SerializesModels;

    public string $title;
    public string $appointment_date;
    public string $reminder_time;
    public string $user_email;
    /**
     * Create a new job instance.
     */
    public function __construct($title, $appointment_date, $reminder_time, $user_email)
    {
        $this->title = $title;
        $this->appointment_date = $appointment_date;
        $this->reminder_time = $reminder_time;
        $this->user_email = $user_email;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user_email)->send(new MailSend($this->title, $this->appointment_date, $this->reminder_time, $this->user_email));
    }
}
