<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $appointments = [];
    if (auth()->check()){
        $appointments = auth()->user()->userAppointments()->latest()->get();
    }
    return view('home', ['appointments' => $appointments]);

})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// appointment
Route::post('/create-appointment', [AppointmentController::class, 'createAppointment']);
Route::patch('/edit-appointment/{appointment}', [AppointmentController::class, 'editAppointment']);

