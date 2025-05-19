<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
{
    protected $fillable = ['patient_id', 'doctor_id', 'schedule_id', 'booking_id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->booking_id = Str::uuid();
        });
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'schedule_id');
    }
}
