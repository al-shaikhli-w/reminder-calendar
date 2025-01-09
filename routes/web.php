<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $appointments = auth()->check() ? auth()->user()->userAppointments()->latest()->get() : [];
    return view('home', ['appointments' => $appointments]);
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Appointment routes
Route::post('create-appontment', [AppointmentController::class, 'createAppointment']);
Route::put('edit-appontment/{appointment}', [AppointmentController::class, 'updateAppointment']);
Route::delete('delete-appontment/{appointment}', [AppointmentController::class, 'deleteAppointment']);

// Test email route
Route::get('send-reminder', [ReminderController::class, 'sendReminder']);
