<?php

namespace App\Http\Controllers;

use App\Models\{Event};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointment = Event::where('id', Auth::id()->get());
        return $appointment;
    }


}
