<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminderEmail;
use App\Mail\AppointmentCreate;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function createAppointment(Request $request)
    {
        if (!$request->filled('title')) {
            return redirect()->back()->withErrors(['title' => 'Bitte füllen Sie das Titelfeld aus']);
        }
        if(!$request->filled('appointment_date')){
            return redirect()->back()->withErrors(['appointment_date' => 'Bitte füllen Sie das Terminfeld aus']);
        }
        if(!$request->filled('reminder_time')){
            return redirect()->back()->withErrors(['reminder_time' => 'Bitte füllen Sie das Erinnerungszeitfeld aus']);
        }

        $validatedFields = $this->validateAndSanitize($request);
        $validatedFields['user_id'] = auth()->id();
        Appointment::create($validatedFields);

        // Calculate the delay for kfadsthe rejgfdlkminder email
        $appointmentDate = Carbon::parse($validatedFields['appointment_date']);
        $reminderTime = (int) $validatedFields['reminder_time'];
        $reminderDate = $appointmentDate->subDays($reminderTime);
        $delay = $reminderDate->diffInSeconds(Carbon::now());

        SendReminderEmail::dispatch(
            $validatedFields['title'],
            $validatedFields['appointment_date'],
            $validatedFields['reminder_time'],
            $validatedFields['user_email']
        )->delay($delay);

        return redirect('/')->with('success', 'Appointment created successfully!');
    }

    public function updateAppointment(Appointment $appointment, Request $request)
    {
        if (auth()->id() !== $appointment->user_id) {
            return redirect('/');
        }

        $validatedFields = $this->validateAndSanitize($request);
        $validatedFields['user_id'] = auth()->id();

        $appointment->update($validatedFields);

        return redirect('/');
    }

    public function deleteAppointment (Appointment $appointment)
    {
        if (auth()->id() === $appointment->user_id) {
            $appointment->delete();
        }

        return redirect('/');
    }

    private function validateAndSanitize(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required',
            'appointment_date' => 'required',
            'reminder_time' => 'required',
            'user_email' => 'required',
        ]);

        return array_map('strip_tags', $validated);
    }
}
