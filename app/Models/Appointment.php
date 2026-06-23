<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\AppointmentStatus;

class Appointment extends Model
{
    protected $fillable = ['customer_name', 'service_name', 'status', 'appointment_datetime'];

    protected $casts = [
        'status' => AppointmentStatus::class,
        'appointment_datetime' => 'datetime'
    ];
}
