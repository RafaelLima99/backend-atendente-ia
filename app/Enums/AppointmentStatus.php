<?php

namespace App\Enums;

enum AppointmentStatus:string
{
    case SCHEDULED = 'scheduled';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}
