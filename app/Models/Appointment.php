<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Enums\AppointmentStatusEnum;

#[Fillable(['name', 'email', 'phone', 'date', 'time_slot', 'status', 'notes'])]
class Appointment extends Model
{
    use HasFactory;

    protected $casts = [
        'date'   => 'date',
        'status' => AppointmentStatusEnum::class,
    ];

    public function scopePending($query)
    {
        return $query->where('status', AppointmentStatusEnum::PENDING);
    }

    public function isAvailable(string $date, string $timeSlot): bool
    {
        return !static::where('date', $date)
                      ->where('time_slot', $timeSlot)
                      ->where('status', '!=', AppointmentStatusEnum::CANCELLED)
                      ->exists();
    }

}//end of model
