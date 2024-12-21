<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $incomingFields)
 */
class Appointment extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'title',
        'appointment_date',
        'reminder_time',
        'user_email',
        'user_id'
    ];

    public static function find(array $validateAndSanitize): array
    {
        return $validateAndSanitize;
    }


}
