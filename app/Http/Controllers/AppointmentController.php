<?php

namespace App\Http\Controllers;

use App\Models\{Appointment};
use Illuminate\Http\Request;


class AppointmentController extends Controller
{

    public function createAppointment(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'appointment_date' => 'required',
            'reminder_time' => 'required',
            'user_email' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['appointment_date'] = strip_tags($incomingFields['appointment_date']);
        $incomingFields['reminder_time'] = strip_tags($incomingFields['reminder_time']);
        $incomingFields['user_email'] = strip_tags($incomingFields['user_email']);
        $incomingFields['user_id'] = auth()->id();

        Appointment::create($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Appointment $appointment)
    {
        return view('edit-post', ['appointment' => $appointment]);

    }


}
